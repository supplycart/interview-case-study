<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    function add(AddToCartRequest $request) : RedirectResponse {
        $product = Product::find($request->id);
        auth()->user()->carts()->save($product);

        return redirect()->route('home.index')->with('message', 'Added to cart.');
    }

    function show() : Response {
        $carts = auth()->user()->carts()->with('category')->get();
        $total_price = $carts->sum('price');

        return Inertia::render('Cart/Index', [
            'products' => $carts,
            'carts_count' => $carts->count(),
            'total_price' => $total_price
        ]);
    }
}
