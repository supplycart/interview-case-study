<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->country(),
            'code' => $this->faker->countryCode(),
            'currency' => $this->faker->currencyCode(),
            'tax_name' => $this->faker->text(3),
            'tax_rate' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
