<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Product;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [ 
            [
                'name' => 'Basic Black Tee',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => 'RM30.00',
                'rating' => 4.2,
                'reviewCount' => 75,
                'colors' => json_encode([['name' => 'Black', 'class' => 'bg-black', 'selectedClass' => 'ring-gray-900']]),
                'sizes' => json_encode([
                    ['name' => 'S', 'inStock' => true],
                    ['name' => 'M', 'inStock' => true],
                    ['name' => 'L', 'inStock' => true],
                    ['name' => 'XL', 'inStock' => false],
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Basic White Tee',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg',
                'imageAlt' => "Front of men's Basic Tee in white.",
                'price' => 'RM35.00',
                'rating' => 4.6,
                'reviewCount' => 98,
                'colors' => json_encode([['name' => 'White', 'class' => 'bg-white', 'selectedClass' => 'ring-gray-400']]),
                'sizes' => json_encode([
                    ['name' => 'S', 'inStock' => false],
                    ['name' => 'M', 'inStock' => true],
                    ['name' => 'L', 'inStock' => false],
                    ['name' => 'XL', 'inStock' => true],
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Basic Grey Tee',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                'imageAlt' => "Front of men's Basic Tee in grey.",
                'price' => 'RM40.00',
                'rating' => 3.5,
                'reviewCount' => 32,
                'colors' => json_encode([['name' => 'Gray', 'class' => 'bg-gray-500', 'selectedClass' => 'ring-gray-400']]),
                'sizes' => json_encode([
                    ['name' => 'S', 'inStock' => false],
                    ['name' => 'M', 'inStock' => true],
                    ['name' => 'L', 'inStock' => true],
                    ['name' => 'XL', 'inStock' => true],
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Basic Peach Tee',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-04.jpg',
                'imageAlt' => "Front of men's Basic Tee in peach.",
                'price' => 'RM45.00',
                'rating' => 2.8,
                'reviewCount' => 15,
                'colors' => json_encode([['name' => 'Peach', 'class' => 'bg-peach', 'selectedClass' => 'ring-gray-400']]),
                'sizes' => json_encode([
                    ['name' => 'S', 'inStock' => true],
                    ['name' => 'M', 'inStock' => true],
                    ['name' => 'L', 'inStock' => true],
                    ['name' => 'XL', 'inStock' => true],
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($items as $item) {
            DB::table('product')->insert($item);
        }
    }
}
