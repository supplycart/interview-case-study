<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart($id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart');

        // If cart is empty
        if ($cart === null) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "brand" => $product->brand,
                    "price" => $product->price,
                    "image" => $product->image,
                    "quantity" => 1
                ]
            ];
        } else {
            // If cart not empty & item does exist.
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            // If cart not empty & item doesnt exist.
            } else {
                $cart[$id] = [
                    "name" => $product->name,
                    "brand" => $product->brand,
                    "price" => $product->price,
                    "image" => $product->image,
                    "quantity" => 1
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->withSuccess('Product has been added to cart');
    }

    public function deleteCart()
    {
        $cart = session()->get('cart');

        if ($cart !== null) {
            session()->forget('cart');

            return redirect()->back()->withSuccess('Your cart has been emptied');
        }

        return redirect()->back();
    }

    public function deleteItem($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->withSuccess('Item has been removed');
    }

    public function viewCart()
    {
        if (Auth::check()) {

            $cart = session()->get('cart');

            if ($cart === null) {
                $cart = [];
            }

            return view('cart', ['data' => $cart]);
        }
  
        return redirect("login")->withFailed('You are not allowed to access');
    }
}
