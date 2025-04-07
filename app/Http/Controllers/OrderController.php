<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cartItems = $request->input('cartItems');

        DB::beginTransaction();

        try {

            $sub_total = collect($cartItems)->sum(function ($item) {
                return $item['product']['price'] * $item['quantity'];
            });

            $tax = $sub_total * 0.08; // 8% tax

            $total = $sub_total + $tax;

            //TODO: To implement easy to read unique order ID generation
            $order = Order::create([
                'user_id' => auth()->id(),
                'sub_total' => $sub_total,
                'tax' => $tax,
                'total' => $total,
                'status' => 'payment', // Change this to 'processing' or 'completed' based on your business logic
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price'],
                ]);
            }

            DB::commit();

            // Clear the cart after successful order creation
            // Implement this method in your CartController or as a service
            app(CartController::class)->clearCart();
            // get order with order item

            $order = Order::with('orderItems.product')->find($order->id)->toArray();

            return Inertia::render('Checkout', [
                'message' => 'Order created successfully',
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // echo $e->getMessage(); // Log the error for debugging
            return Inertia::render('OrderError', [
                'message' => 'Order creation failed',
            ]);
        }
    }

    public function history()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('OrderHistory', [
            'orders' => $orders
        ]);
    }
}
