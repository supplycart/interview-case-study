<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => fake()->unique()->jobTitle(),
            'slug' => fn (array $attributes) => str($attributes['title'])->slug(),
            'description' => fake()->sentence(rand(2, 10)),
            'is_active' => true,
        ];
    }
}
