<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

    public function checkout(Request $request){
        
        $cart = Cart::where('user_id', $request->user_id)->get();
        
        $total = 0;

        foreach($cart as $item){
            $product = Product::find($item->product_id);
            $total += $product->price * $item->qty;
        }
        
        DB::beginTransaction();

        try {
            $order_id = generate_unique_id('O-', "Order", "order_id");
            $order_exited = Order::where(['user_id' => $request->user_id, 'status' => 1])->exists();
            
            if($order_exited){
                return response()->json(['data' => 'Please Paid current order.'], 404);
            }

            Order::create([
                'order_price' => $total,
                'order_id' => $order_id,
                'user_id' => $request->user_id,
                'status' => 1,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
        }

        DB::commit();

        return response()->json(['data' => 'order made!'], 200);
    }
}
