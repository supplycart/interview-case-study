<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Macbook Air 13" M1 16GB 256GB',
                'category' => 'Laptop',
                'brand' => 'Apple',
                'description' => 'Macbook Air 13" M1 16GB 256GB',
                'quantity' => 10,
                'price' => 400_000, // 4,000.00
            ],
            [
                'name' => 'iPhone 16 128GB',
                'category' => 'Smartphone',
                'brand' => 'Apple',
                'description' => 'iPhone 16 128GB',
                'quantity' => 10,
                'price' => 300_000, // 3,000.00
            ],
            [
                'name' => 'Galaxy S24 Ultra 256GB',
                'category' => 'Smartphone',
                'brand' => 'Samsung',
                'description' => 'Galaxy S24 Ultra 256GB',
                'quantity' => 10,
                'price' => 500_000, // 5,000.00
            ],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category']]);
            $brand = Brand::firstOrCreate(['name' => $product['brand']]);
            Product::create([
                'name' => $product['name'],
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'description' => $product['description'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
    }
}
