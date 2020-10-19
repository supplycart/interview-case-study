<?php

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
        $products = [
            [
                'id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Samsung S20',
                'price' => 4000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 2,
                'brand_id' => 2,
                'category_id' => 1,
                'name' => 'iPhone 12',
                'price' => 5000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 3,
                'brand_id' => 1,
                'category_id' => 2,
                'name' => 'Samsung A71',
                'price' => 3000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 4,
                'brand_id' => 2,
                'category_id' => 2,
                'name' => 'iPhone SE (2020)',
                'price' => 3500.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 5,
                'brand_id' => 3,
                'category_id' => 2,
                'name' => 'Xiaomi mi10',
                'price' => 2000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 6,
                'brand_id' => 1,
                'category_id' => 3,
                'name' => 'Samsung A11',
                'price' => 1000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 7,
                'brand_id' => 3,
                'category_id' => 3,
                'name' => 'Xiaomi mi10lite',
                'price' => 1000.00,
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
        ];

        DB::table('products')->insert($products);
    }
}
