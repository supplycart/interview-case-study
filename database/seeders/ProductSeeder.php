<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name'              => 'Sensodyne Repair & Protect Toothpaste',
            'sku'               => '876845945',
            'description'       => 'Sensodyne is proven relief from the tooth discomfort and provides long-lasting sensitivity protection',
            'cost_price'        => '17',
            'price'             => '25',
            'quantity'          => '35',
            'category_id'       => 4,
            'brand_id'          => 1,
        ]);
        Product::create([
            'name'              => 'Sensodyne Sensitivity & Gum Toothpaste',
            'sku'               => '876868945',
            'description'       => 'Sensodyne is proven relief from the tooth discomfort and provides long-lasting sensitivity protection',
            'cost_price'        => '15',
            'price'             => '23',
            'quantity'          => '30',
            'category_id'       => 4,
            'brand_id'          => 1,
        ]);
        Product::create([
            'name'              => 'Maggi Instant Noodles Curry',
            'sku'               => '768794',
            'description'       => 'Have it original or up your Maggi® game to Fried Asam Laksa, Goreng Mamak or Basah. Take your pick of different flavours to suit your palette and for the family.',
            'cost_price'        => '3',
            'price'             => '5',
            'quantity'          => '100',
            'category_id'       => 4,
            'brand_id'          => 3,
        ]);
        Product::create([
            'name'              => 'Maggi Instant Noodles Chicken',
            'sku'               => '7983453',
            'description'       => 'Have it original or up your Maggi® game to Fried Asam Laksa, Goreng Mamak or Basah. Take your pick of different flavours to suit your palette and for the family.',
            'cost_price'        => '3.50',
            'price'             => '6',
            'quantity'          => '100',
            'category_id'       => 4,
            'brand_id'          => 3,
        ]);
    }
}
