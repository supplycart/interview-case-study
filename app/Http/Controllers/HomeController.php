<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {   
        $qproduct = Product::query();

        if($name = $request->input('name')){
            $qproduct->where('name', 'like', "%$name%");
        }
        $products =  $qproduct->get();

        $users = User::get();
        $carts = Cart::with('user', 'product')->where('user_id',auth()->user()->id)->get();
        $orders = Order::where('user_id',auth()->user()->id)->get();

         if($request->wantsJson()){
            return [$products, $carts, $users];
        }

        return view('home', compact('products', 'users', 'carts', 'orders'));
    }

    public function addcart(Request $request)
    {   
        $request->validate([
            'quantity' => 'required'
        ]);
        
        // Checking if record already exist add the quantity
        $id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $qcart = Cart::query()->where('product_id', $id)->where('user_id', auth()->user()->id)->first();
        if($qcart != null){
            $qcart->quantity = $qcart->quantity + $quantity;
            $qcart->save();
        }
        else{
        $cart = new Cart;
        $cart->user_id = auth()->user()->id; 
        $cart->product_id = $request->input('product_id'); 
        $cart->quantity = $request->input('quantity'); 
        $cart->save();
        }

        return redirect()->route('index')->with(['success' => 'The record have been add to your cart']);
    }

    public function checkout()
    {
        $qcarts = Cart::query()->where('user_id', auth()->user()->id)->get();
        foreach($qcarts as $cart){
            $order = new Order;
            $order->user_id = $cart->user_id;
            $order->product_id = $cart->product_id;
            $order->quantity = $cart->quantity;
            $order->save();
            $cart->delete();
        }


        return redirect()->back()->with(['success' => 'Your Order has been sent!! :)']);

    }
}
