<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PropertyFactory;
use Database\Factories\GoodFactory;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = PropertyFactory::new()->count(10)->create();

        GoodFactory::new()->count(222)
            ->hasAttached($properties, fn () => [
                'property_id' => $properties->toQuery()->inRandomOrder()->value('id'),
                'value' => fake()->unique()->sentence(rand(1, 3)),
            ])
            ->create();
    }
}
