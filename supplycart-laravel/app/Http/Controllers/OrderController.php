<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Validate the incoming items array
        $orderData = $request->validate([
            'items' => 'required|array|min:1', // Ensure the 'items' field is an array and not empty
            'items.*.product_id' => 'required|integer|exists:products,id', // Each product ID must exist in the 'products' table
            'items.*.quantity' => 'required|integer|min:1', // Quantity must be at least 1
        ]);

        $totalPrice = 0; // Initialize total price

        // Create an order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'To Ship', // Set order status to: To Ship
            'date' => now(),
        ]);

        // Loop through each item and create OrderItem, while calculating the total price from DB
        foreach ($orderData['items'] as $item) {
            $product = Product::find($item['product_id']); // Retrieve the product from the database

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404); // Handle product not found
            }

            $itemPrice = $product->price; // Fetch the product price from DB
            $itemQuantity = $item['quantity']; // Quantity from the request

            // Add the subtotal for this item to the total price
            $totalPrice += $itemPrice * $itemQuantity;

            // Create an order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $itemQuantity,
                'price' => $itemPrice, // Save the product price from DB
            ]);

            // Subtract the ordered quantity from product stock
            $product->stock -= $itemQuantity;

            // If stock becomes negative or zero, throw error
            if ($product->stock < 0) {
                return response()->json(['message' => 'Insufficient stock for product: ' . $product->name], 400);
            }

            $product->save(); // Save the updated product stock value

            // Remove item from cart after order is placed
            CartItem::where('cart_id', auth()->user()->cart->id)
                ->where('product_id', $product->id)
                ->delete();
        }

        // Update the order with the calculated total price
        $order->update([
            'total_price' => $totalPrice,
        ]);

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
