<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.products', compact('products'));
    }
    public function cart()
    {
        return view('shop.cart');
    }
    public function addToCart($id)
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "photo" => $product->photo
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    
    // public function createOrder(array $data)
    // {
    //     if (Auth::check())
    //     {
    //         $productArray = [];
    //         foreach ($data as $id){
    //             array_push($productArray, $id);
    //         }
    //         return Order::create([
    //             'user_id' => Auth::id(),
    //             'products' => $productArray,
    //         ]);
    //     }
    // }   

    public function checkout()
    {
        $cart = session()->get('cart');
        if($cart) {
            $keys = array_keys($cart);
            $id = Auth::id();
            $products = json_encode($cart);
            // echo $products;
            Order::create([
                'user_id' => $id,
                'products' => $products
              ]);
            $cart = [];
            session()->put('cart', $cart);
            return redirect()->route('ordersindex')->with('success', 'Checkout successful');
        }
    }


}
