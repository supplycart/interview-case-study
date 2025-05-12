<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'country_id' => Country::factory(),
            'amount' => fake()->randomFloat(2, 1_000, 1_000_000),
        ];
    }
}
