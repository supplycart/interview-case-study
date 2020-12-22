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
            'VectoTech Rapid 1TB External SSD',
        ];

        $list = [
            [
                'name'     => 'Galaxy',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-tab-a7-104-2020.jpg',
                    'https://fdn2.gsmarena.com/vv/bigpic/galaxy-tab-s6-lite.jpg',
                ],
                'category' => "Tablet",
                'brand'    => "Samsung",
            ],
            [
                'name'     => 'Ipad',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/apple-ipad-pro-129-2018.jpg',
                    'https://fdn2.gsmarena.com/vv/bigpic/apple-ipad8-102-inches-2020.jpg',
                ],
                'category' => "Tablet",
                'brand'    => "Apple",
            ],
            [
                'name'     => 'Xperia',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/sony-xperia-z2-tablet.jpg',
                ],
                'category' => "Tablet",
                'brand'    => "Apple",
            ],
            [
                'name'     => 'Galaxy',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-a12-sm-a125.jpg',
                    'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-m21s.jpg',
                    'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s20-fe-4g.jpg',
                ],
                'category' => "Smartphone",
                'brand'    => "Samsung",
            ],
            [
                'name'     => 'Iphone',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-12-pro-max-.jpg',
                    'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-xs-new.jpg',
                ],
                'category' => "Smartphone",
                'brand'    => "Apple",
            ],
            [
                'name'     => 'Xperia',
                'image'    => [
                    'https://fdn2.gsmarena.com/vv/bigpic/sony-xperia-5-ii-5g-r.jpg',
                ],
                'category' => "Smartphone",
                'brand'    => "Sony",
            ],
            [
                'name'     => 'Macbook',
                'image'    => [
                    'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mbp-spacegray-select-202011?wid=904&hei=840&fmt=jpeg&qlt=80&op_usm=0.5,0.5&.v=1603406905000',
                ],
                'category' => "Laptop",
                'brand'    => "Apple",
            ],
            [
                'name'     => 'Galaxy',
                'image'    => [
                    'https://image-us.samsung.com/SamsungUS/home/mobile/tablets/pdp/sm-w767pzaaspr/gallery/Gallery-GalaxyBookS-1-11620.jpg?$product-card-small-jpg$',
                ],
                'category' => "Laptop",
                'brand'    => "Samsung",
            ],
        ];

        $types = ["S1", "S2", "S3", "S4", "S5", "S6", "S7", "S8", "Z10", "P10", "S10", "Note", "RTX", "ZTX", "PRO"];


        $products = [];

        for ($i = 0; $i < 75; $i++) {
            $item    = collect($list)->random();
            $product = [
                'brand_id'    => Brand::firstOrCreate(['name' => $item['brand']])->id,
                'category_id' => Category::firstOrCreate(['name' => $item['category']])->id,
                'name'        => $item['name']." ".collect($types)->random(),
                'image'       => collect($item['image'])->random(),
                'description' => "best product from ".$item['brand'],
                'stock'       => 100,
                'price'       => rand(100, 1000),
            ];

            array_push($products, $product);
        }

        DB::table('products')->insert($products);
    }
}
