<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch the authenticated user's orders
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)->get();

        // Fetch the user's tier
        $user = User::find($userId);
        $userTier = $user->user_tier;

        // Process each order to include detailed product info
        $processedOrders = [];

        foreach ($orders as $order) {
            // Decode the order_items array from JSON
            $orderItems = json_decode($order->order_items, true);

            // Array to hold the updated order items with product details
            $updatedOrderItems = [];

            foreach ($orderItems as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    // Find the price based on the user's tier
                    $price = collect(json_decode($product->price))->firstWhere('user_tier', $userTier);

                    if ($price) {
                        $updatedOrderItems[] = array_merge($item, [
                            'product_name' => $product->product_name,
                            'product_brand' => $product->product_brand,
                            'product_category' => $product->product_category,
                            'price' => $price,
                        ]);
                    } else {
                        Log::warning("Price not found for product ID: {$item['product_id']}, user tier: $userTier");
                    }
                }
            }

            // Add the processed order with updated order items
            $processedOrders[] = [
                'id' => $order->id,
                'total_price' => $order->total_price,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'order_items' => $updatedOrderItems,  // Add the processed items here
            ];
        }

        // Return the processed orders with detailed product info
        return response()->json([
            'message' => 'Order history retrieved successfully',
            'orders' => $processedOrders,
        ]);
    }

    // Fetch a specific order by ID for the authenticated user
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'message' => 'Order retrieved successfully',
            'order' => $order,
        ]);
    }
}
