<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Brand
        $brandBismi = Brand::where("code", "bismi")->first();
        $brandAdabi = Brand::where("code", "adabi")->first();
        $brandGardenia = Brand::where("code", "gardenia")->first();
        $brandRamly = Brand::where("code", "ramly")->first();
        $brandJulies = Brand::where("code", "julies")->first();

        // Category
        $categoryBakery = Category::where("code", 'bakery')->first();
        $categoryCooking = Category::where("code", 'cooking')->first();
        $categoryMeat = Category::where("code", 'meat')->first();
        $categoryBiscuits = Category::where("code", 'biscuits')->first();

        $products = [
            // Bismi
            [
                'name' => 'Freshy Frozen Chicken Potong 9',
                'brand_id' => $brandBismi->id,
                'category_id' => $categoryMeat->id,
                'price' => 20.50,
                'premium_price' => 18.50,
                'product_qty' => 100,
                'image_path' => 'images/products/FFC-9-ADJUST.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Freshy Frozen Chicken Potong 12',
                'brand_id' => $brandBismi->id,
                'category_id' => $categoryMeat->id,
                'price' => 23.50,
                'premium_price' => 21.50,
                'product_qty' => 100,
                'image_path' => 'images/products/FFC-12-ADJUST.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Freshy Frozen Chicken Wing (1kg)',
                'brand_id' => $brandBismi->id,
                'category_id' => $categoryMeat->id,
                'price' => 20.50,
                'premium_price' => 18.50,
                'product_qty' => 100,
                'image_path' => 'images/products/FFC-WING-ADJUST.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Freshy Frozen Chicken Thigh (1kg)',
                'brand_id' => $brandBismi->id,
                'category_id' => $categoryMeat->id,
                'price' => 20.50,
                'premium_price' => 18.50,
                'product_qty' => 100,
                'image_path' => 'images/products/FFC-THIGH-ADJUST.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Adabi
            [
                'name' => 'Adabi Serbuk Kerutuk Ayam & Daging (250g)',
                'brand_id' => $brandAdabi->id,
                'category_id' => $categoryCooking->id,
                'price' => 8.50,
                'premium_price' => 6.50,
                'product_qty' => 100,
                'image_path' => 'images/products/638814182539530000.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Adabi Serbuk Kari Ayam & Daging (24g)',
                'brand_id' => $brandAdabi->id,
                'category_id' => $categoryCooking->id,
                'price' => 1.30,
                'premium_price' => 0.50,
                'product_qty' => 100,
                'image_path' => 'images/products/638814428586430000.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Adabi Serbuk Kari Ikan (24g)',
                'brand_id' => $brandAdabi->id,
                'category_id' => $categoryCooking->id,
                'price' => 1.30,
                'premium_price' => 0.50,
                'product_qty' => 100,
                'image_path' => 'images/products/638813751203900000.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Gardenia
            [
                'name' => 'Gardenia Original Classic',
                'brand_id' => $brandGardenia->id,
                'category_id' => $categoryBakery->id,
                'price' => 4.30,
                'premium_price' => 3.50,
                'product_qty' => 100,
                'image_path' => 'images/products/72deba3f8aee6bc65e4fa38f81fcc4ae.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gardenia Wholemeal',
                'brand_id' => $brandGardenia->id,
                'category_id' => $categoryBakery->id,
                'price' => 4.30,
                'premium_price' => 3.50,
                'product_qty' => 100,
                'image_path' => 'images/products/22e407d3135b3e8119b874cbc09e76cc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gardenia Butterscotch',
                'brand_id' => $brandGardenia->id,
                'category_id' => $categoryBakery->id,
                'price' => 4.30,
                'premium_price' => 3.50,
                'product_qty' => 100,
                'image_path' => 'images/products/58bf0a370b39c0f5d35b6abf33021282.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Ramly
            [
                'name' => 'Burger Ayam (6 Pcs)',
                'brand_id' => $brandRamly->id,
                'category_id' => $categoryMeat->id,
                'price' => 7.20,
                'premium_price' => 5.50,
                'product_qty' => 100,
                'image_path' => 'images/products/chicken-burger.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Burger Ayam (6 Pcs)',
                'brand_id' => $brandRamly->id,
                'category_id' => $categoryMeat->id,
                'price' => 7.20,
                'premium_price' => 5.50,
                'product_qty' => 100,
                'image_path' => 'images/products/burger-daging.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Julies
            [
                'name' => 'Rich Tea Oat (10 Packs)',
                'brand_id' => $brandJulies->id,
                'category_id' => $categoryBiscuits->id,
                'price' => 5.20,
                'premium_price' => 3.50,
                'product_qty' => 100,
                'image_path' => 'images/products/1733994418.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Butter Crackers (8 Packs)',
                'brand_id' => $brandJulies->id,
                'category_id' => $categoryBiscuits->id,
                'price' => 5.20,
                'premium_price' => 3.50,
                'product_qty' => 100,
                'image_path' => 'images/products/87a4fd78cc9012c1609f40ac0cd6c5e7.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
