<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Here you would typically process the payment
        // For this example, we'll just simulate a successful payment

        // Simulate payment processing delay

        $order = Order::with('orderItems.product')->find($request->id)->toArray();

        sleep(2);

        // Return a successful response
        return Inertia::render('Checkout', [
            'message' => 'Order created successfully',
            'order' => $order,
        ]);
    }

    public function complete($orderNumber)
    {
        // change order status to delivery
        Order::where('id', $orderNumber)->update(['status' => 'delivery']);

        return Inertia::render('PaymentComplete', [
            'orderNumber' => $orderNumber
        ]);
    }
}
