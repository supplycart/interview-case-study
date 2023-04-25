<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Add products with categories and attributes
        Product::factory(10)->create()->each(function (Product $product) {
            $product->categories()->attach(Category::factory()->create());

            // Create attributes and options without factory
            $product->attributes()->saveMany(
                Attribute::factory(3)->create()->each(function (Attribute $attribute) {
                    $attribute->options()->saveMany(Option::factory(3)->create()->each(function (Option $option) {
                        $option->stocks()->saveMany(Stock::factory(3)->create());
                    }));
                })
            );
        });
    }
}
