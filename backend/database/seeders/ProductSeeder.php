<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories and brands
        $electronicsCategory = Category::where('name', 'Electronics')->first();
        $clothingCategory = Category::where('name', 'Clothing')->first();
        $booksCategory = Category::where('name', 'Books')->first();

        $appleBrand = Brand::where('name', 'Apple')->first();
        $samsungBrand = Brand::where('name', 'Samsung')->first();
        $padiniBrand = Brand::where('name', 'Padini')->first();
        $uniqloBrand = Brand::where('name', 'Uniqlo')->first();
        $fixiBrand = Brand::where('name', 'FIXI')->first();
        $kinokuniyaBrand = Brand::where('name', 'Kinokuniya')->first();


        $products = [
            [
                'name' => 'iPhone 14',
                'description' => 'Latest iPhone model.',
                'price_in_cents' => 120000, // $1200.00
                'stock_quantity' => 10,
                'category_id' => $electronicsCategory->id ?? null,
                'brand_id' => $appleBrand->id ?? null,
            ],
            [
                'name' => 'Galaxy S23',
                'description' => 'Latest Samsung Galaxy model.',
                'price_in_cents' => 110000, // $1100.00
                'stock_quantity' => 15,
                'category_id' => $electronicsCategory->id ?? null,
                'brand_id' => $samsungBrand->id ?? null,
            ],
            [
                'name' => 'T-Shirt (Padini)',
                'description' => 'A comfortable cotton t-shirt from Padini.',
                'price_in_cents' => 2500, // $25.00
                'stock_quantity' => 50,
                'category_id' => $clothingCategory->id ?? null,
                'brand_id' => $padiniBrand->id ?? null,
            ],
            [
                'name' => 'Ultra Light Down Jacket (Uniqlo)',
                'description' => 'Lightweight down jacket from Uniqlo.',
                'price_in_cents' => 7990, // $79.90
                'stock_quantity' => 20,
                'category_id' => $clothingCategory->id ?? null,
                'brand_id' => $uniqloBrand->id ?? null,
            ],
            [
                'name' => 'Lagenda Budak Setan',
                'description' => 'Popular novel from FIXI.',
                'price_in_cents' => 3000, // $30.00
                'stock_quantity' => 30,
                'category_id' => $booksCategory->id ?? null,
                'brand_id' => $fixiBrand->id ?? null,
            ],
            [
                'name' => 'Japanese Language Book',
                'description' => 'A Japanese language learning book from Kinokuniya.',
                'price_in_cents' => 6000, // $60.00
                'stock_quantity' => 25,
                'category_id' => $booksCategory->id ?? null,
                'brand_id' => $kinokuniyaBrand->id ?? null,
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price_in_cents' => $productData['price_in_cents'],
                'stock_quantity' => $productData['stock_quantity'],
                'category_id' => $productData['category_id'], // Assign category_id
                'brand_id' => $productData['brand_id'],       // Assign brand_id
            ]);
        }

        // Seed more products if needed, linking them to random categories/brands
        // You might want to refine this to ensure realistic pairings
        $categories = Category::all();
        $brands = Brand::all();

        if ($categories->isNotEmpty() && $brands->isNotEmpty()) {
            Product::factory()->count(10)->create([
                'category_id' => $categories->random()->id,
                'brand_id' => $brands->random()->id, // This might link an electronics product to a clothing brand, refine if needed
            ]);
        } else {
            // Fallback if no categories or brands are seeded
            Product::factory()->count(10)->create();
        }
    }
}
