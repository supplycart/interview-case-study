<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductPriceCountry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPricesTableSeeder extends Seeder
{
    public function run()
    {
        Product::pluck('id')->each(function ($item) {

            DB::table('product_prices')->insert([
                'product_id' => $item,
                'price' => rand(100, 1000),
                'is_default' => true
            ]);

            for ($i = 0; $i < 2; $i++) {
                $id = DB::table('product_prices')->insertGetId([
                    'product_id' => $item,
                    'price' => 100.00,
                    'is_default' => false
                ]);

                DB::table('product_price_countries')->insert([
                    'country' => ProductPriceCountry::countriesAvailable()[$i],
                    'product_price_id' => $id
                ]);
            }
        });
    }
}
