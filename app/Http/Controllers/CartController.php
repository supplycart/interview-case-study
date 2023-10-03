<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    function add(AddToCartRequest $request) : RedirectResponse {
        $product = Product::find($request->id);
        auth()->user()->carts()->save($product);

        return redirect()->route('home.index')->with('message', 'Added to cart.');
    }
}
