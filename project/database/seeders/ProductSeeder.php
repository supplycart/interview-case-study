<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create(['name' => 'Product 1', 'description' => 'Description for product 1', 'price' => 100.00]);
        Product::create(['name' => 'Product 2', 'description' => 'Description for product 2', 'price' => 150.00]);
        Product::create(['name' => 'Product 3', 'description' => 'Description for product 3', 'price' => 200.00]);
        Product::create(['name' => 'Product 4', 'description' => 'Description for product 4', 'price' => 210.00]);
        Product::create(['name' => 'Product 5', 'description' => 'Description for product 5', 'price' => 220.00]);
        Product::create(['name' => 'Product 6', 'description' => 'Description for product 6', 'price' => 230.00]);
    }
}
