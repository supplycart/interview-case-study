<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Small', 'Medium', 'Large', '1kg', '2kg', '3kg']),
            'attribute_id' => Attribute::factory()
        ];
    }
}
