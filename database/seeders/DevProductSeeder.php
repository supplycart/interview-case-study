<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'History Book',
                'category_id' => 1,
                'price' => 30.00,
            ],
            [
                'name' => 'Artist Concert Ticket',
                'category_id' => 2,
                'price' => 50.00,
            ],
            [
                'name' => 'Crazy Rich Book',
                'category_id' => 1,
                'price' => 15.00,
            ],
            [
                'name' => 'About Elon Musk Book',
                'category_id' => 1,
                'price' => 23.99,
            ],
            [
                'name' => 'Sky High Movie Ticket',
                'category_id' => 2,
                'price' => 20.00,
            ],
            [
                'name' => 'Greeks Methology Book',
                'category_id' => 1,
                'price' => 40.50,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'category_id' => $product['category_id'],
                'price' => $product['price'],
            ]);
        }
    }
}
