<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            [
                'name' => 'Shirt',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna.'
            ],
            [
                'name' => 'Dress',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna.'
            ],
            [
                'name' => 'Pants',
            ],
            [
                'name' => 'Blouse',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna.'
            ],
        ];

        foreach ($categoryData as $data) {
            Category::firstOrCreate($data);
        }
    }
}
