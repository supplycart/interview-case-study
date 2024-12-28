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
            'name' => $this->faker->words(3, true), // Random product name
            'sku' => strtoupper($this->faker->unique()->lexify('???-????-???')), // Unique SKU
            'description' => $this->faker->paragraph(), // Random description

        ];
    }
}
