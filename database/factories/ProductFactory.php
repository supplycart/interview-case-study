<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->title,
            'product_description' => $this->faker->sentence(8),
            'product_category' => Str::random(10),
            'product_discount' => $this->faker->numberBetween(0, 100),
            'available_stock' => $this->faker->numberBetween(0, 1000)
        ];
    }
}
