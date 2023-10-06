<?php

namespace Database\Seeders;

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
                'name' => 'Product 1',
                'brand_id' => '1',
                'category_id' => '1',
                'sku' => 'product-1-red',
                'description' => 'Product 1 in red.',
                'price' => 119.99,
                'image' => '/images/fit-pants.jpeg',
            ],
            [
                'name' => 'Product 2',
                'brand_id' => '2',
                'category_id' => '2',
                'sku' => 'product-2-blue',
                'description' => 'Product 2 in blue.',
                'price' => 129.99,
            ],
            [
                'name' => 'Product 3',
                'brand_id' => '1',
                'category_id' => '1',
                'sku' => 'product-3-black',
                'description' => 'Product 3 in black.',
                'price' => 139.99,
                'image' => '/images/sense-pants.avif',
            ],
            [
                'name' => 'Product 4',
                'brand_id' => '2',
                'category_id' => '2',
                'sku' => 'product-4-green',
                'description' => 'Product 4 in green.',
                'price' => 149.99,
                'image' => '/images/cargo-pants.png',
            ],
            [
                'name' => 'Product 5',
                'brand_id' => '3',
                'category_id' => '3',
                'sku' => 'product-5-pink',
                'description' => 'Product 5 in pink.',
                'price' => 159.99,
            ],
            [
                'name' => 'Product 6',
                'brand_id' => '4',
                'category_id' => '4',
                'sku' => 'product-6-pink',
                'description' => 'Product 6 in gray.',
                'price' => 159.99,
                'image' => '/images/addidas-pants.avif',
            ],

        ];

        foreach ($products as $product) {
            Product::firstOrCreate($product);
        }
    }
}
