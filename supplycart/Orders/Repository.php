<?php

namespace supplycart\Orders;

use App\Models\Order;
use App\Models\Cart;

class Repository
{
    public function getOrdersByUser(string $userId): object
    {
        try {
            return Order::where('user_id', $userId)->with('carts')->get();
        } catch(\Exception $e) {
            return collect(new Order);
        }
    }
    
    /**
     * @param string $userId
     * @param array $products
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function create(string $userId, array $products): object
    {
        $order = new Order;
        $order->user_id = $userId;
        $order->save();
        $orderTotal = 0;
        foreach ($products as $product) {
            $cart = new Cart;
            $cart->product_id = $product->id;
            $cart->order_id = $order->id;
            $cart->quantity = $product->count;
            $cart->total = $product->price;
            $cart->subtotal = $product->price * $product->count;
            $cart->save();
            $orderTotal =+ $cart->subtotal;
        }
        $order->total = $orderTotal;
        $order->save();
        return $order;
    }
}
