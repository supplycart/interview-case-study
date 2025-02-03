<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        $carts = Cart::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        foreach ($carts as $cart) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                CartItem::create([
                    'cart_id' => $cart,
                    'product_id' => $products[array_rand($products)],
                    'quantity' => rand(1, 3),
                ]);
            }
        }
    }
}
