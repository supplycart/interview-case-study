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
        // Define user tiers
        $tiers = [
            'basic' => [
                'discount' => 0,
                'price_multiplier' => 1.0,
            ],
            'silver' => [
                'discount' => 5,
                'price_multiplier' => 0.95,
            ],
            'gold' => [
                'discount' => 10,
                'price_multiplier' => 0.90,
            ],
            'platinum' => [
                'discount' => 15,
                'price_multiplier' => 0.85,
            ],
        ];

        // Calculate the base price
        $basePrice = $this->faker->randomFloat(2, 10, 1000); // Random price between 10 and 1000

        // Prepare prices for all tiers
        $prices = [];
        foreach ($tiers as $tierKey => $tierDetails) {
            $discountedPrice = $basePrice * $tierDetails['price_multiplier'];
            $prices[] = [
                'user_tier' => $tierKey,
                'amount' => round($discountedPrice, 2),
                'currency' => 'USD',
            ];
        }

        return [
            'product_name' => $this->faker->word().' '.$this->faker->word(),
            'product_brand' => $this->faker->company(),
            'product_category' => $this->faker->word(),
            'price' => json_encode($prices), // Store all tier prices in a JSON array
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
