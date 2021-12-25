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
        $product = new Product();
        $product->product_name = 'Women\'s Red dress';
        $product->category = 'A';
        $product->stock = 50;
        $product->discount = 10;
        $product->price = 250;
        $product->picture_a = "img/products/red.png";
        $product->picture_b = "img/products/blue.png";
        $product->picture_c = "img/products/white.png";
        $product->save();

        $product = new Product();
        $product->product_name = 'Hawa Luxe Premium';
        $product->category = 'A';
        $product->stock = 50;
        $product->discount = 10;
        $product->price = 350;
        $product->picture_a = "img/products/red.png";
        $product->picture_b = "img/products/blue.png";
        $product->picture_c = "img/products/white.png";
        $product->save();
        
    }
}
