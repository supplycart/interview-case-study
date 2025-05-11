<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->unique()->words(3, true); // Generate a unique product name (3 words)
        return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate slug from the name
            'description' => fake()->paragraph(3), // 3 sentences
            'price_in_cents' => fake()->numberBetween(100, 100000), // Price between $1.00 and $1000.00
            'stock_quantity' => fake()->numberBetween(0, 200), // Stock between 0 and 200
        ];
    }
}
