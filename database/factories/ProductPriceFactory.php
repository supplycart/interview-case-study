<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'price' => $this->faker->numberBetween(100, 1000),
            'is_default' => rand(true, false)
        ];
    }
}
