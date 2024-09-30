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
        if (!isset($this->cart_items) || !is_array($this->cart_items)) {
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
        // Checkout logic as before
        $order = Order::create([
            'user_id' => $this->user_id,
            'cart_items' => json_encode($this->cart_items), // Save cart items for the order
        ]);

        // Clear the cart after checkout
        $this->cart_items = [];
        $this->save();

        return $order;
    }
}
