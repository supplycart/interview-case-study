<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryBrand;
use App\Models\ProductCategory;
use App\Models\ProductBrand;

class CategoryBrandSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::pluck('id')->toArray();
        $brands = ProductBrand::pluck('id')->toArray();

        // make sure to set proper relationship between brand & catgeory
        foreach ($brands as $brand) {
            CategoryBrand::create([
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brand,
            ]);
        }
    }
}
