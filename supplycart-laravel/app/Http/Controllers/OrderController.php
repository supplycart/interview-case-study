<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $orders = Order::with('items.product') // Eager load order items and products
                        ->where('user_id', $userId)
                        ->orderBy('date', 'desc')
                        ->get();

        return response()->json([
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Create a new order
    public function store(Request $request)
    {
        $orderData = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'To Ship', // Set order status to: To Ship
            'date' => now(),
        ]);

        // Loop through each item and create OrderItem, while calculating the total price from DB
        foreach ($orderData['items'] as $item) {
            $product = Product::find($item['product_id']);

            if ($product->stock < $item['quantity']) {
                return response()->json(['message' => 'Insufficient stock for product: ' . $product->name], 400);
            }

            $totalPrice += $product->price * $item['quantity'];

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            // Update stock
            $product->stock -= $item['quantity'];
            $product->save();

            // Check if the user has a cart
            $cart = auth()->user()->cart;
            if ($cart) {
                // Remove item from the cart
                CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->delete();
            }
        }

        // Update the order total price
        $order->total_price = $totalPrice;
        $order->save();

        return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id]);
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
