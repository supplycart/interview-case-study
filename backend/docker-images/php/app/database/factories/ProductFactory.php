<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
    	return [
		    'name'        => $this->faker->name,
		    'short'       => $this->faker->text(50),
		    'description' => $this->faker->text(),
		    'price'       => $this->faker->randomFloat(2, 1, 100),
		    'thumb'       => 'products/product.jpg',
		    'status'      => 'PUBLISH'
    	];
    }
}
