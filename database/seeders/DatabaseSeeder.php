<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        
        \App\Models\Product::factory(50)->create();

        \App\Models\Order::insert(['user_id' => 1, 'total' => 10]);
        \App\Models\OrderItem::insert(['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 10, 'total' => 10]);
    }
}
