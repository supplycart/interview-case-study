<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductPriceCountry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->times(3)
            ->create();
//            ->has(ProductPrice::factory()->count(4), 'prices')
    }
}
