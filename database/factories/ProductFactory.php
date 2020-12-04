<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => 100
        ];
    }
}
