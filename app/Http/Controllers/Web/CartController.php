<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CartProduct\CartProduct as CartProductResource;
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
        $products = $cart->products;
        return view('app.cart', ['cart_products' => $cart->products]);
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
        $requested_quantity = isset($request->product_quantity) ? $request->product_quantity : 1;
        $cart = Auth::user()->cart;
        $cart_id = Auth::user()->cart->id;
        $product_id = $product->id;
        $updated = DB::table('cart_product')
                ->updateOrInsert(
                    ['cart_id' => $cart_id, 'product_id' => $product_id],
                    [
                        'product_quantity' => $requested_quantity,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

        return redirect(route('cart'))->with(
            'cart_add_success',
            'Succesfully added to cart'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $cart_id = Auth::user()->cart->id;
        $product_id = $product->id;
        $updated = DB::table('cart_product')
                ->where('cart_id', '=', $cart_id)
                ->where('product_id', '=', $product_id)
                ->update(
                    [
                        'product_quantity' => $request->product_quantity,
                        'updated_at' => now(),
                    ]
                );

        return back()->with(
            'cart_update_success',
            'Succesfully updated item quantity'
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

        return back()->with(
            'cart_remove_success',
            'Succesfully removed item(s) from cart'
        );
    }
}
