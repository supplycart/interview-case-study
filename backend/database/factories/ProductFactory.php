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
            'Name' => $this->faker->words(6, true),
            'Detail' => $this->faker->sentences(2, true),
            'Stock' => $this->faker->numberBetween(1, 40),
            'Price' => $this->faker->randomFloat(2, 1, 100),
            'Img' => $this->faker->imageUrl(600, 400, 'grocery',true),
        ];
    }
}
