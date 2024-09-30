<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\MasterLookup;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();

        \App\Models\Product::factory(100)
            ->has(ProductImage::factory()->count(5), 'images')
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'status_id' => MasterLookup::whereType('product_status')->pluck('id')->random(),
                    'brand_id'  => Brand::pluck('id')->random()
                ],
            ))
            ->create()
            ->each(function (\App\Models\Product $product) use ($categories) {
                $product->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
