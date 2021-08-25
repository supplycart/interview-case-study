<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Get the view for order history page
     */
    public function order()
    {
        $ordersProducts = Order::where('user_id', Auth::user()->id)
                        ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                        ->join('products', 'order_products.product_id', '=', 'products.id')
                        ->select('order_id', 'name', 'price', 'quantity', 'total')
                        ->orderby('order_id', 'desc')
                        ->get()
                        ->groupby('order_id');
       
        return view('order', compact('ordersProducts')); 
    }

    /**
     * Place an order.
     */
    public function placeOrder()
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => \Cart::getTotal()
        ]);
        
        $cartItems = \Cart::getContent();
        foreach ($cartItems as $item)
        {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);
        }

        \Cart::clear();

        return redirect()->route('order');
    }
}
