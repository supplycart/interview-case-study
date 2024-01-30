<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController
{
    public function getCart($user_id){
        $cart = Cart::where('user_id', $user_id)->get();

        return response()->json(['data' => $cart], 200);
    }

    public function addToCart($product_id){
        
    }
}
