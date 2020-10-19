<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedProductForNestle_();
        $this->seedProductForPowerRoot_();
        $this->seedProductForSamyang_();
    }

    private function seedProductForNestle_()
    {
        $products = [
            [
                'id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Milo 3 in 1',
                'unit_price' => '12.50',
                'stock_count' => 5,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 2,
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Nescafe 3 in 1',
                'unit_price' => '12.00',
                'stock_count' => 5,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 3,
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Nesquik',
                'unit_price' => '8.50',
                'stock_count' => 2,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 4,
                'brand_id' => 1,
                'category_id' => 2,
                'name' => 'Maggi Kari',
                'unit_price' => '5.50',
                'stock_count' => 2,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 5,
                'brand_id' => 1,
                'category_id' => 3,
                'name' => 'KitKat',
                'unit_price' => '2.50',
                'stock_count' => 4,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate($product);
        }
    }

    private function seedProductForPowerRoot_()
    {
        $products = [
            [
                'id' => 6,
                'brand_id' => 2,
                'category_id' => 1,
                'name' => 'Power Root 3 in 1',
                'unit_price' => '12.50',
                'stock_count' => 5,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 7,
                'brand_id' => 2,
                'category_id' => 2,
                'name' => 'Power Root Instant Noodle',
                'unit_price' => '2.00',
                'stock_count' => 0,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 8,
                'brand_id' => 2,
                'category_id' => 3,
                'name' => 'Power Root Biscuits',
                'unit_price' => '4.50',
                'stock_count' => 4,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate($product);
        }
    }

    private function seedProductForSamyang_()
    {
        $products = [
            [
                'id' => 9,
                'brand_id' => 3,
                'category_id' => 1,
                'name' => 'Samyang Cola',
                'unit_price' => '2.50',
                'stock_count' => 5,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 10,
                'brand_id' => 3,
                'category_id' => 2,
                'name' => 'Samyang carbonara',
                'unit_price' => '22.50',
                'stock_count' => 2,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ],

            [
                'id' => 11,
                'brand_id' => 3,
                'category_id' => 3,
                'unit_price' => '7.50',
                'name' => 'Samyang Biscuits',
                'stock_count' => 4,
                'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, voluptatibus molestiae? Recusandae commodi, ab repellat provident tempore illum eos dolor."
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate($product);
        }
    }
}
