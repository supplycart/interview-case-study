<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Product\Product as ProductResource;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Auth::user()->cart;
        $products = ProductResource::collection($cart->products);
        return view('app.cart', ['cart_products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $cart = Auth::user()->cart;
        $requested_quantity = isset($request->quantity) ? $request->quantity : 1;
        $cart->products()->attach($product, ['product_quantity' => $requested_quantity]);

        return redirect(route('cart'))->with(
            'cart_success',
            'Succesfully added to cart'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $cart = Auth::user()->cart;
        $cart->products()->detach($product);

        return back();
    }
}
