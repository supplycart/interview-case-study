<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Get the view for order history page
     */
    public function order()
    {
        // Get the orders and their corresponding products that
        // are previously placed by the user
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
     * Place an order. Redirect to order page if there are 
     * items in cart to be placed an order.
     */
    public function placeOrder()
    {
        // Check if cart is empty
        if (\Cart::isEmpty()) {
            session()->flash('error', 'No Items in Cart!');
            return redirect()->route('cart.list');
        }

        // Store order data
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => \Cart::getTotal()
        ]);
        
        // Store product data for the order
        $cartItems = \Cart::getContent();
        foreach ($cartItems as $item)
        {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);
        }

        // Clear the cart
        \Cart::clear();
        session()->flash('success', 'Order placed successfully!');
        return redirect('order');
    }
}
