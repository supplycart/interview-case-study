<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function createOrder($user_id, $cart){
        DB::beginTransaction();
        try {
            $coupon_id = null;
            $total = 0;

            $order_id = generate_unique_id('O-', "Order", "order_id");
            $order_exited = Order::where(['user_id' => $user_id, 'status' => 1])->exists();
            
            if($order_exited){
                return response()->json(['data' => 'Please Paid current order.'], 404);
            }

            $order = new Order;
            $order->order_id = $order_id;
            $order->user_id = $user_id;
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
    }
}