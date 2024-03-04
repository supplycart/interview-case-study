<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\DB;

class CartController
{
    public function __construct(CartRepository $cartRepository) {
        $this->_cartRepository = $cartRepository;
    }

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

        DB::beginTransaction();
        try {
            $coupon_id = null;
            $total = 0;

            $order_id = generate_unique_id('O-', "Order", "order_id");
            $order_exited = Order::where(['user_id' => $request->user_id, 'status' => 1])->exists();
            
            if($order_exited){
                return response()->json(['data' => 'Please Paid current order.'], 404);
            }

            $order = new Order;
            $order->order_id = $order_id;
            $order->user_id = $request->user_id;
            $order->status = 1;
            $order->save();
            
            foreach($cart as $item){
                $product = Product::find($item->product_id);

                $total += $product->price * $item->qty;
                
                $order_detail = new OrderDetail;
                $order_detail->product_id = $product->id;
                $order_detail->product_price = $product->price;
                $order_detail->qty = $item->qty;
                $order_detail->order_id = $order->id;
                $order_detail->save();

                $item->delete();
            }

            $order->order_price = $total;
            $order->save();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['data' => $e->getMessage()], 404);
        }

        DB::commit();

        return response()->json(['data' => 'order made!'], 200);
    }
}
