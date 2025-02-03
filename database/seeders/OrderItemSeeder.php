<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        foreach ($orders as $order) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                OrderItem::create([
                    'order_id' => $order,
                    'product_id' => $products[array_rand($products)],
                    'quantity' => rand(1, 3),
                ]);
            }
        }
    }
}
