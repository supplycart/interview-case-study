<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Samsung Galaxy S9',
            'description' => 'The Samsung Galaxy S9 features a 5.8" display, 12MP back camera, 8MP front camera, and a 3000mAh battery capacity. It also comes with Octa Core CPU and runs on Android.',
            'photo' => 'https://p.ipricegroup.com/uploaded_29326edc09f06d172651deb0f2ce2ded.jpg',
            'price' => 1260.00
        ]);

        DB::table('products')->insert([
            'name' => 'LG V10 H900',
            'description' => 'The LG V10 features a 5.7" display, 16MP back camera, 5MP front camera, and a 3000mAh battery capacity. It also comes with Hexa Core CPU and runs on Android.',
            'photo' => 'https://p.ipricegroup.com/uploaded_29326edc09f06d172651deb0f2ce2ded.jpg',
            'price' => 620.00
        ]);

        DB::table('products')->insert([
            'name' => 'HUAWEI Mate 40 Pro',
            'description' => 'The Huawei Mate 40 Pro features a 6.76" display, 50MP back camera, 13MP front camera, and a 4400mAh battery capacity.',
            'photo' => 'https://p.ipricegroup.com/uploaded_2dbbc559e55a743b84fba3abeb87d63f.jpg',
            'price' => 4299.00
        ]);

        DB::table('products')->insert([
            'name' => 'HTC One M10',
            'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
            'photo' => 'https://p.ipricegroup.com/uploaded_7048abf98fa315a499343730edda2b10.jpg',
            'price' => 750.00
        ]);
    }
}
