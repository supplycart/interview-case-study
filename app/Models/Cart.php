<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'cart_items'];

    // Cast the cart_items attribute to an array
    protected $casts = [
        'cart_items' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Ensure cart_items is an array when creating a new instance
        if (! isset($this->cart_items) || ! is_array($this->cart_items)) {
            $this->cart_items = [];
        }
    }

    public function addProduct($product, $quantity)
    {
        // Ensure cart_items is an array
        $cartItems = is_array($this->cart_items) ? $this->cart_items : [];

        // Check if the product already exists in the cart
        $existingItemKey = array_search($product->id, array_column($cartItems, 'product_id'));

        if ($existingItemKey !== false) {
            // Update quantity if product exists
            $cartItems[$existingItemKey]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cartItems[] = ['product_id' => $product->id, 'quantity' => $quantity];
        }

        // Update cart_items and save the cart
        $this->cart_items = $cartItems;
        $this->save();
    }

    public function removeProduct($product)
    {
        // Ensure cart_items is an array
        $cartItems = is_array($this->cart_items) ? $this->cart_items : [];

        // Filter out the product from cart items
        $this->cart_items = collect($cartItems)->filter(function ($item) use ($product) {
            return $item['product_id'] !== $product->id;
        })->values()->all();

        $this->save();
    }

    public function checkout()
    {
        // Ensure cart_items is an array
        $cartItems = is_array($this->cart_items) ? $this->cart_items : [];

        // Fetch the user's tier
        $user = User::find($this->user_id);
        $userTier = $user->user_tier;

        // Calculate the total price of the cart
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                // Find the price based on the user's tier
                $price = collect(json_decode($product->price))->firstWhere('user_tier', $userTier);
                if ($price) {
                    $totalPrice += $price->amount * $item['quantity'];
                } else {
                    // Log or handle the case where the price is not found
                    Log::warning("Price not found for product ID: {$item['product_id']}, user tier: $userTier");
                }
            }
        }

        // Create the order with the total price
        $order = Order::create([
            'user_id' => $this->user_id,
            'order_items' => json_encode($cartItems),  // Save cart items for the order
            'total_price' => $totalPrice, // Append the calculated total price
        ]);

        // Clear the cart after checkout
        $this->cart_items = [];
        $this->save();

        return $order;
    }
}
