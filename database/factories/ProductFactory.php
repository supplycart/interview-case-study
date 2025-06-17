<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected static int $sequence = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = 'B';

        return [
            'name' => $this->faker->word,
            'code' => $prefix . str_pad(self::$sequence++, 3, '0', STR_PAD_LEFT),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock_quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
