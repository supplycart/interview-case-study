<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(3, true),
            'price' => $this->faker->randomFloat(2, 200, 500),
            'special_price' => $this->faker->randomFloat(2, 90, 200),
            'image_src' => $this->faker->imageUrl(640, 480),
        ];
    }
}
