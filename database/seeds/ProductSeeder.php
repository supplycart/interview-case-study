<?php

// namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name'        => 'Calpis Smooth Grape Flavour Cultured Milk Drink 1L',
                'price'       => 5.00,
                'description' => 'Calpis Original Cultured Milk Drink is fat free and does not contain any preservatives. Pour it over shaved ice in the hot sunny day and you’ll have “kakigori”, a popular snack during summer time in Japan.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/46114/36645-1.jpg',
                'stock'       => 10,
                'brand'       => 'Calpis',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => 'Calpis Smooth Strawberry Flavour Cultured Milk Drink 1L',
                'price'       => 5.00,
                'description' => 'Calpis Original Cultured Milk Drink is fat free and does not contain any preservatives. Pour it over shaved ice in the hot sunny day and you’ll have “kakigori”, a popular snack during summer time in Japan.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/54137/SC00042416.jpg',
                'stock'       => 20,
                'brand'       => 'Calpis',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => 'Drinho Chrysanthemum Tea 1L',
                'price'       => 2.29,
                'description' => 'Drinho Asian drinks are made from natural ingredients and are processed under the most stringent quality control. All Drinho products are free from preservatives and are certified halal.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/71527/SC00036899.jpg',
                'stock'       => 5,
                'brand'       => 'Drinho',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => 'Drinho Green Tea 1L',
                'price'       => 2.29,
                'description' => 'Drinho Asian drinks are made from natural ingredients and are processed under the most stringent quality control. All Drinho products are free from preservatives and are certified halal.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/47027/32446-1.jpg',
                'stock'       => 10,
                'brand'       => 'Drinho',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => 'Drinho Soya Bean 1L',
                'price'       => 2.29,
                'description' => 'Drinho Asian drinks are made from natural ingredients and are processed under the most stringent quality control. All Drinho products are free from preservatives and are certified halal.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/45917/36950-1.jpg',
                'stock'       => 10,
                'brand'       => 'Drinho',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => '100 Plus Regular 500ML',
                'price'       => 2.20,
                'description' => 'An active lifestyle rewards your mind and body. Formulated to quickly quench your thirst, 100 Plus replenishes the fluids, electrolytes and energy* that you lose.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/72198/SC00041794.jpg',
                'stock'       => 30,
                'brand'       => '100 Plus',
                'category'    => 'Flavoured Drinks',
            ],
            [
                'name'        => 'Baskin Robbins Cookies n Cream Ice Cream 500ML',
                'price'       => 34.90,
                'description' => 'Baskin Robbins Vanilla flavored ice cream with lots of cream filled chocolate cookie chunks throughout',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/74359/SC00042037.jpg',
                'stock'       => 6,
                'brand'       => 'Baskin Robin',
                'category'    => 'Ice Cream',
            ],
            [
                'name'        => 'Baskin Robbins Ice Cream Very Berry Strawberry 500ML',
                'price'       => 34.90,
                'description' => 'Baskin Robbins very berry ice cream is ice cream with artificial or natural very berry flavoring',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/60269/SC00042770.jpg',
                'stock'       => 8,
                'brand'       => 'Baskin Robin',
                'category'    => 'Ice Cream',
            ],
            [
                'name'        => 'Wall`s Ice Cream Choco Nutty Crunch 750ML',
                'price'       => 13.50,
                'description' => 'Chocolate flavoured ice confection with chocolate flavoured syrup and honey roasted almonds, peanuts, hazelnuts and cashew nuts.',
                'image'       => 'https://supplycart-media.s3.ap-southeast-1.amazonaws.com/56382/SC00040097.jpg',
                'stock'       => 10,
                'brand'       => 'Walls',
                'category'    => 'Ice Cream',
            ]
        ];

        $products = [];

        for ($i = 0; $i < 9; $i++) {
            $product = [
                'name'        => $list[$i]['name'],
                'price'       => $list[$i]['price'],
                'description' => $list[$i]['brand'],
                'image'       => $list[$i]['image'],
                'stock'       => $list[$i]['stock'],
                'brand_id'    => Brand::firstOrCreate(['name' => $list[$i]['brand']])->id,
                'category_id' => Category::firstOrCreate(['name' => $list[$i]['category']])->id,
            ];

            array_push($products, $product);
        }

        DB::table('products')->insert($products);
    }
}
