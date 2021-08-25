<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get the view for cart.
     */
    public function cart()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }


    /**
     * Add a product to cart. 
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product Added to Cart Successfully!');

        return redirect()->route('cart.list');
    }

    /**
     * Update the quantity of a product in cart.
     * 
     * @param  \Illuminate\Http\Request  $request
     */   
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Cart Updated Successfully!');

        return redirect()->route('cart.list');
    }

    /**
     * Remove a product from cart.
     * 
     * @param  \Illuminate\Http\Request  $request
     */ 
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Product Removed from Cart Successfully!');

        return redirect()->route('cart.list');
    }

    /**
     * Clear the cart, i.e. remove all products from cart.
     */
    public function clearCart()
    {
        \Cart::clear();
        session()->flash('success', 'Cart Cleared Successfully !');

        return redirect()->route('cart.list');
    }
}
