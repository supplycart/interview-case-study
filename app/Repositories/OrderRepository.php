<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Cart;
use DB;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function createOrder($user_id){
        DB::beginTransaction();
        try {
            $coupon_id = null;
            $total = 0;

            $order_id = generate_unique_id('O-', "Order", "order_id");
            $order_exited = Order::where(['user_id' => $user_id, 'status' => 1])->exists();

            if($order_exited){
                // return response()->json(['data' => 'Please Paid current order.'], 401);
                throw new \Exception('Please Paid current order.');
            }
            $order = Order::create([
                'order_id' => $order_id,
                'user_id' => Auth::user()->id,
                'status' => 1
            ]);
            
            $cart = Cart::where('user_id', $user_id)->get();
            
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

            activity()
                ->log($user_id, 'Order '.$order->order_id.' Created');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}