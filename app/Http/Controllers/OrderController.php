<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->get();

        $statusArray = Order::STATUS_ARRAY;
        $paymentStatusArray = Order::PAYMENT_STATUS_ARRAY;

        return Inertia::render('Order/Index', [
            'orders' => $orders,
            'statusArray' => $statusArray,
            'paymentStatusArray' => $paymentStatusArray,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems;

        $order = Order::create([
            'user_id' => $user->id,
            'status'=> Order::STATUS_PENDING,
            'payment_status' => Order::PAYMENT_STATUS_PAID,
        ]);

        $totalAmount = 0;

        foreach ($cartItems as $cartItem) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $totalAmount += $orderItem->quantity * $orderItem->price;

            $cartItem->delete();
        }

        $order->total_price = $totalAmount;
        $order->save();

        return Inertia::render('Order/Success', [
            'order' => $order,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
