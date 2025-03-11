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
    public function definition(): array
    {
        return [
            'title' => fake()->words(),
            'description' => fake()->catchPhrase(),
            'base_price' => fake()->numberBetween(1, 100),
            'discount_type_for_member' => 'fixed',
            'discounted_rate_for_member' => null,
            'discounted_price_for_member' => fake()->numberBetween(1, 100),
        ];
    }
}

