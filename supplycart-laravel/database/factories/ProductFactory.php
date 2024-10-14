<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Product::CATEGORIES;

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image_url' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
            'category' => $categories[array_rand($categories)],
            'brand_id' => rand(1, 5),
        ];
    }
}
