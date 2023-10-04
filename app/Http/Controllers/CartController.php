<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    function add(AddToCartRequest $request) : RedirectResponse {
        auth()->user()->user_carts()->create([
            'product_id' => $request->id
        ]);

        return redirect()->route('home.index')->with('message', 'Added to cart.');
    }

    function remove(RemoveFromCartRequest $request) : RedirectResponse {
        $user_cart = auth()->user()->user_carts()->find($request->id);
        $user_cart->delete();

        return redirect()->route('cart.show')->with('message', 'Removed from cart.');
    }

    function show() : Response {
        $user_carts = auth()->user()->user_carts()->with('product.category')->get();
        $total_price = $user_carts->pluck('product')->sum('price');

        return Inertia::render('Cart/Index', [
            'user_carts' => $user_carts,
            'carts_count' => auth()->user()->carts->count(),
            'total_price' => $total_price
        ]);
    }
}
