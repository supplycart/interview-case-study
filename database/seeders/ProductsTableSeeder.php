<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
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
        $usersId = User::pluck('id');

        $brandsId = Brand::pluck('id');

        $categoriesId = Category::pluck('id');

        $titles = [
            'LG Gram Laptop - 14" Full HD IPS Display',
            'SAMSUNG 970 EVO Plus SSD 2TB - M.2 NVMe ',
            'WD 1TB My Passport SSD External Portable',
            'Crucial X6 1TB Portable SSD – Up to ',
            'VectoTech Rapid 1TB External SSD'
        ];

        $products = [];

        for ($i = 0; $i < 40; $i++) {
            $product =[
                    'user_id' => $usersId->random(),
                    'brand_id' => $brandsId->random(),
                    'category_id' => $categoriesId->random(),
                    'title' => collect($titles)->random(),
                    'description' => 'Lorem ipsum',
                    'stock' => 100];

            array_push($products, $product);
        }

        DB::table('products')->insert($products);


    }
}
