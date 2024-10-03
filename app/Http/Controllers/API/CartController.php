<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController
{
    public function __construct(CartRepository $cartRepository) {
        $this->_cartRepository = $cartRepository;
    }

    public function getCart(Request $request){
        $cart = Cart::leftJoin('products', 'cart.product_id', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->get();

        return response()->json(['data' => $cart], 200);
    }

    public function addToCart($product_id){
        $cart = Cart::where(['product_id' => $product_id, 'user_id' => Auth::user()->id])->first();

        if($cart){
            $cart->increment('qty',1);

            return response()->json(['data' => true], 200);
        }

        Cart::create([
            'product_id' => $product_id,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['data' => true], 200);
    }

    public function remove($cart_id){
        try {
            Cart::where(['product_id' => $cart_id, 'user_id' => Auth::user()->id])->delete();

            return response()->json(['data' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['messages' => $e->getMessage()], 400);
        }
    }
}
