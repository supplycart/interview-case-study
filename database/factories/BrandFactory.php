<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;
    
    public function definition(): array 
    {
        return [
            'name' => fake()->company,
            'slug' => fn (array $attributes) => str($attributes['name'])->slug(),
        ];
    }
}
