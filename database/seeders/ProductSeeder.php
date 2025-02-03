<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBrand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::pluck('id')->toArray();
        $brands = ProductBrand::pluck('id')->toArray();

        // seed 10 records with random category & brand
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'description' => 'This is a description for Product ' . $i,
                'price' => mt_rand(10, 500) / 10,
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],
            ]);
        }
    }
}
