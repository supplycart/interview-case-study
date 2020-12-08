<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Category::CATEGORIES as $category) {
            Category::create(['name' => $category]);
        }
    }
}
