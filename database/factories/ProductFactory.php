<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->sentence(2),
            "picture" => $this->faker->file('public/images/products', 'public/images/fakers', false),
            "cat_id" => $this->faker->numberBetween(1, 5),
            "price" => $this->faker->randomFloat(2, 10, 100),
            "inventory" => $this->faker->numberBetween(0, 1000),
            "description" => $this->faker->sentence(8),
            "tags" => $this->faker->regexify("([a-z]{5}>){4,6}")
        ];
    }
}
