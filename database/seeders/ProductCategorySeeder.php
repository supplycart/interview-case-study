<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Electronics', 'Furniture', 'Clothing', 'Books', 'Accessories'];

        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category]);
        }
    }
}
