<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class ShopController extends Controller
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
        $products = $this->getProducts();
        return view('shop', compact('products'));
    }

    public function cart()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $total = array_sum(array_map(function ($product) {
            return $product->total;
        }, $cart));
        return view('cart', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $user = Auth::user();

        if(empty($cart)) {
            return Redirect::route('shop');
        }

        $total = array_sum(array_map(function ($product) {
            return $product->total;
        }, $cart));

        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $total;
        $order->save();

        $orderItems = [];
        foreach($cart as $product) {
            $orderItems[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->qty,
                'price' => $product->price,
                'total' => $product->total
            ];
        }
        OrderItem::insert($orderItems);

        session()->put('cart', []);

        return Redirect::route('shop');
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) { 
            //Product not found so abort.
            abort(404);
        }

        //Check if session already has cart, if not create new one
        $cart = session()->has('cart') ? session()->get('cart') : [];

        //Check if cart already has the product id, so can just add qty
        //TODO: Check Stock
        if (isset($cart[$id])) {
            $cart[$id]->qty++;
            $cart[$id]->total =  $cart[$id]->qty *  $cart[$id]->price;
        } else {
            $cart[$id] = (object) [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'total' => $product->price,
                'image_path' => $product->image_path
            ];
        }
        session()->put('cart', $cart);
        return response()->json($cart);
    }

    public function getProducts()
    {
        return Product::limit(30)->get();
    }
}
