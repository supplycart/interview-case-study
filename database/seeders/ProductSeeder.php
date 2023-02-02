<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'product_name'=>"Gaming PC",
                'product_description'=>"Powerful PC for gaming",
                'product_image'=>'cpu.jpeg',
                'product_price'=>7999.00,
            ]);
        Product::create(
            [
                'product_name'=>"Gaming Mouse",
                'product_description'=>"Powerful mouse for gaming",
                'product_image'=>'mouse.jpeg',
                'product_price'=>179.00,
            ]);
        Product::create(
            [
                'product_name'=>"Gaming Keyboard",
                'product_description'=>"Powerful keyboard for gaming",
                'product_image'=>'keyboard.jpeg',
                'product_price'=>499.00,
            ]);
        Product::create(
            [
                'product_name'=>"Gaming Monitor",
                'product_description'=>"Powerful monitor for gaming",
                'product_image'=>'monitor.jpeg',
                'product_price'=>799.00,
            ]);
    }
}
