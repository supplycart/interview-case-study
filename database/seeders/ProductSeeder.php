<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Brand;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all()->pluck('id', 'name');
        $categories = Category::all()->pluck('id', 'name');
        $dummy_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin turpis elit, quis facilisis magna volutpat nec. Nam neque tellus.';
        DB::table('products')->insert([
            [
                'name' => 'Black Super Mini GG Marmont Bag',
                'description' => $dummy_description,
                'category_id' => $categories['Bags'],
                'brand_id' => $brands['Gucci'],
                'image' => '/images/bags/gucci1.webp',
                'price' => 5000
            ],
            [
                'name' => 'Passy',
                'description' => $dummy_description,
                'category_id' => $categories['Bags'],
                'brand_id' => $brands['Louis Vuitton'],
                'image' => '/images/bags/lv1.webp',
                'price' => 11300
            ],
            [
                'name' => 'Lambskin Classic Handbag',
                'description' => $dummy_description,
                'category_id' => $categories['Bags'],
                'brand_id' => $brands['Channel'],
                'image' => '/images/bags/channel1.webp',
                'price' => 4000
            ],
            [
                'name' => 'Maxi GG wool-blend zip-up hoodie',
                'description' => $dummy_description,
                'category_id' => $categories['Clothes'],
                'brand_id' => $brands['Gucci'],
                'image' => '/images/clothes/gucci1.webp',
                'price' => 4000
            ],
            [
                'name' => 'Monogram Denim Shawl',
                'description' => $dummy_description,
                'category_id' => $categories['Clothes'],
                'brand_id' => $brands['Louis Vuitton'],
                'image' => '/images/clothes/lv1.webp',
                'price' => 2550
            ],
            [
                'name' => 'Tween',
                'description' => $dummy_description,
                'category_id' => $categories['Clothes'],
                'brand_id' => $brands['Louis Vuitton'],
                'image' => '/images/clothes/channel1.webp',
                'price' => 3550
            ],
        ]);
    }
}
