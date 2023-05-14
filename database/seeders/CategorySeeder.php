<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Fresh Product',
        ]);
        Category::create([
            'name' => 'Bakery',
        ]);
        Category::create([
            'name' => 'Beverage',
        ]);
        Category::create([
            'name' => 'Grocery',
        ]);
        Category::create([
            'name' => 'Home & Gardening',
        ]);
    }
}
