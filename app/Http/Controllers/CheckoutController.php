<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Checkout');
    }

     /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->total = $request->total;
        $order->items = json_encode($request->items);
        $order->save();
        
        // Redirect to the checkout success page
        return redirect()->route('checkout_success.index');
    }
}
