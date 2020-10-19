<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Beverage',
            ],

            [
                'id' => 2,
                'name' => 'Instant Noodle',
            ],

            [
                'id' => 3,
                'name' => 'Snacks',
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate($category);
        }
    }
}
