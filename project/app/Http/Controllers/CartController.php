<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;


class CartController extends Controller
{
    public function view()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = \App\Models\Product::find($id);

        if (!$product) {
            return redirect()->route('cart.show')->with('error', 'Product not found!');
        }

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        ActivityLogger::log(auth()->user(), 'Add to Cart', 'Added product: ' . $product->name);
        return back()->with('success', $product->name .' added to cart successfully!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.view')->with('success', 'Cart cleared!');
    }

}

