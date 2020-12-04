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
            'description' => $this->faker->realText(100),
            'quantity' => $this->faker->randomDigit,
            'price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
            'status' => $this->faker->boolean,
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
