<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\UserProductPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and products
        $users = User::all();
        $products = Product::all();

        // Create some specific user-product price overrides
        if ($users->isNotEmpty() && $products->isNotEmpty()) {
            // Example: Give the first user a discounted price on the first product
            UserProductPrice::create([
                'user_id' => $users->first()->id,
                'product_id' => $products->first()->id,
                'price_in_cents' => 1800, // $18.00 (discounted from original $20.00)
            ]);

            // Example: Give the second user a higher price on the second product
            if ($users->count() > 1 && $products->count() > 1) {
                UserProductPrice::create([
                    'user_id' => $users[1]->id,
                    'product_id' => $products[1]->id,
                    'price_in_cents' => 5500, // $55.00 (higher than original $50.00)
                ]);
            }

            // Seed more random user-product prices
            for ($i = 0; $i < 20; $i++) { // Create 20 random overrides
                $user = $users->random();
                $product = $products->random();

                // Check if an override already exists for this user and product
                if (!UserProductPrice::where('user_id', $user->id)->where('product_id', $product->id)->exists()) {
                    // Create a price that is +/- 10% of the original product price
                    $originalPrice = $product->price_in_cents;
                    $variation = $originalPrice * (rand(-10, 10) / 100);
                    $newPrice = max(100, $originalPrice + $variation); // Ensure price is at least 100 cents ($1)

                    UserProductPrice::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'price_in_cents' => round($newPrice),
                    ]);
                }
            }
        }
    }
}
