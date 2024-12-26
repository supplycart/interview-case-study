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
                'sku' => 'SKU-1',
                'description' => 'Product 1 description',
                'variations' => [
                    ['sku' => 'SKU-1-1', 'price' => 100],
                    ['sku' => 'SKU-1-2', 'price' => 200],
                    ['sku' => 'SKU-1-3', 'price' => 300],
                ],
            ],
            [
                'name' => 'Product 2',
                'sku' => 'SKU-2',
                'description' => 'Product 2 description',
                'variations' => [
                    ['sku' => 'SKU-2-1', 'price' => 100],
                    ['sku' => 'SKU-2-2', 'price' => 200],
                    ['sku' => 'SKU-2-3', 'price' => 300],
                ],
            ],
            [
                'name' => 'Product 3',
                'sku' => 'SKU-3',
                'description' => 'Product 3 description',
                'variations' => [
                    ['sku' => 'SKU-3-1', 'price' => 100],
                    ['sku' => 'SKU-3-2', 'price' => 200],
                    ['sku' => 'SKU-3-3', 'price' => 300],
                ],
            ],
        ];

        foreach ($products as $product) {
            $productModel = Product::firstOrCreate([
                'sku' => $product['sku'],
            ], [
                'name' => $product['name'],
                'description' => $product['description'],
            ]);

            foreach ($product['variations'] as $variation) {
                $productModel->variations()->firstOrCreate([
                    'sku' => $variation['sku'],
                ], [
                    'price' => $variation['price'],
                ]);
            }
        }
    }
}
