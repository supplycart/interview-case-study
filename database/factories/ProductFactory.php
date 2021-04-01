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
            'name' => ucwords($this->faker->words(rand(1, 3), true)),
            'description' => $this->faker->sentence(rand(3, 8)),
            'price' => $this->faker->randomFloat(2, 0, 2021),
            'image_url' => 'http://placeimg.com/640/480/tech',
        ];
    }
}
