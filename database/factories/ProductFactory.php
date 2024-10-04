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
        $price    = $this->faker->randomFloat(2, 1, 1000);
        $discount = $this->faker->randomFloat(2, 0, 20) * $price / 100;

        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->text,
            'price'       => $price,
            'discount'    => $discount,
            'currency'    => 'MYR',
            'stock'       => $this->faker->numberBetween(1, 100),
        ];
    }
}
