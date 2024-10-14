<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition()
    {
        return [
            'cart_id' => Cart::factory(), // Create a cart if not provided
            'product_id' => Product::factory(), // Create a product if not provided
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
