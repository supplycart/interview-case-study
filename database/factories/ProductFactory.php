<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $titles = [
            'LG Gram Laptop - 14" Full HD IPS Display',
            'SAMSUNG 970 EVO Plus SSD 2TB - M.2 NVMe ',
            'WD 1TB My Passport SSD External Portable',
            'Crucial X6 1TB Portable SSD – Up to ',
            'VectoTech Rapid 1TB External SSD'
        ];

        return [
            'user_id' => User::factory(),
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'title' => collect($titles)->random(),
            'description' => $this->faker->realText(),
            'stock' => 100
        ];
    }
}
