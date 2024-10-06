<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all orders and associate random products with them
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            // Add 3 items to each order
            $orderItems = $products->random(3);

            foreach ($orderItems as $product) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => rand(1, 5),
                    'price'      => $product->price,
                ]);
            }
        }
    }
}
