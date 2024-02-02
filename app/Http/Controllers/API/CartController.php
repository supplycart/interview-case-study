<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController
{
    public function getCart($user_id){
        $cart = Cart::leftJoin('products', 'cart.product_id', 'products.id')
            ->where('user_id', $user_id)
            ->get();

        return response()->json(['data' => $cart], 200);
    }

    public function addToCart(Request $request, $product_id){
        $cart = Cart::where(['product_id' => $product_id, 'user_id' => $request->user_id])->first();

        if($cart){
            $cart->increment('qty',1);

            return response()->json(['data' => 'added'], 200);
        }

        Cart::create([
            'product_id' => $product_id,
            'user_id' => $request->user_id
        ]);

        return response()->json(['data' => true], 200);
    }
}
