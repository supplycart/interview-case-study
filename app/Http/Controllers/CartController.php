<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use \App\Models\Product;
use \App\Models\Cart;
use \App\Models\UserCart;
use \App\Models\UserOrder;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            $userCarts = UserCart::where("user_id", Auth::id())->get();
            return view('cart', ["cart_items" => $userCarts]);
        }else{
            return view('logout');
        }
    }

    public function placeOrder(){
        if (Auth::check()){
            $userCarts = Auth::user()->carts;
            if (count($userCarts) > 0){
                //then place order
                $newOrder = new UserOrder();
                $newOrder->user_id = Auth::id();
                $newOrder->order_uuid = Str::uuid();
                $newOrder->save();
                $orderProductRelation = [];
                foreach($userCarts as $cartItem){
                    $orderProductRelation[] = [
                        "user_order_id"=> $newOrder->id,
                        "product_id"=>$cartItem->product->id,
                        "created_at"=>Carbon::now(),
                        "updated_at"=>Carbon::now(),
                    ];
                }
                DB::table("user_order_product")->insert($orderProductRelation);

                //assume all query success, delete all the item of this user's cart
                UserCart::where("user_id", Auth::id())->delete();
            }
        }

        
        $productList = Product::all();
        return view('product', ['products' => $productList]);
    }

    public function add(Request $request){
        $validated = $request->validate([
            'productId' => 'required|max:12',
        ]);

        if (Auth::check() && $validated){
            $product = Product::find($request->productId);
            if ($product != null){
                $existingUserCart = UserCart::where("user_id", Auth::id())->where("product_id", $product->id)->first();
                if ($existingUserCart != null){
                    $existingUserCart->quantity++;
                }else{
                    $existingUserCart = new UserCart();
                    $existingUserCart->user_id = Auth::id();
                    $existingUserCart->product_id = $product->id;
                    $existingUserCart->quantity = 1;
                }
                $existingUserCart->save();
            }
        }
        
        $productList = Product::all();
        return view('product', ['products' => $productList]);
    }
}
