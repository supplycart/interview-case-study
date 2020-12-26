<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
                    ->times(10)
                    ->create();

        $c = Category::all();
        Product::all()->each(function ($p) use ($c) {
            $p->categories()->attach(
                $c->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
