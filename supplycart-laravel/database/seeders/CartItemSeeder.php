<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add products to cart
        Cart::all()->each(function ($cart) {
            $products = Product::inRandomOrder()->take(3)->get(); // Get random products
            foreach ($products as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 5), // Random quantity
                    'price' => $product->price, // Use the product price at the time
                ]);
            }
        });
    }
}
