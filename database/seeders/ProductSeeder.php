<?php

namespace Database\Seeders;

use App\Helpers\MasterLookupHelper;
use App\Models\ProductImage;
use Database\Factories\ProductImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->create([
                'status_id' => 1,
            ])
            ->each(function (\App\Models\Product $product) use ($categories) {
                $product->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
