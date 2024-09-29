<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'uuid' => fake()->unique()->uuid,
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'goods_cost' => fake()->numberBetween(100, 10000),
            'delivery_cost' => fake()->numberBetween(0, 100),
            'total_cost' => fn (array $attributes) => $attributes['goods_cost'] + $attributes['delivery_cost'],
        ];
    }
}
