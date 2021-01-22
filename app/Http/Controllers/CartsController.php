<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('cart')->with('products', $products);
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
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);

            return response()->json(['status' => 1, 'message' => 'Product added to cart successfully!']);
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return response()->json(['status' => 1, 'message' => 'Product added to cart successfully!']);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return response()->json(['status' => 1, 'message' => 'Product added to cart successfully!']);
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
            return response()->json(['status' => 1, 'message' => 'Cart updated successfully']);

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

            return response()->json(['status' => 1, 'message' => 'Cart updated successfully']);
        }
    }
}
