<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $categorySeeds = [
            'Fruit',
            'Cloth',
            'Furniture',
        ];

        foreach ($categorySeeds as $index => $categorySeed)
        {
            Category::create([ 'name' => $categorySeed, 'position' => $index + 1 ]);
        }

        $productSeeds = [
            '1' => [
                [
                    'title' => 'Red Apple',
                    'description' => 'Fresh red apple picked from nearby farm',
                    'base_price' => 3.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 2.99,
                ],
                [
                    'title' => 'Green Apple',
                    'description' => 'Fresh green apple picked from nearby farm',
                    'base_price' => 4.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 2.99,
                ],
                [
                    'title' => 'Banana',
                    'description' => 'Fresh red apple picked from nearby farm',
                    'base_price' => 3.66,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 2.66,
                ],
                [
                    'title' => 'Watermelon',
                    'description' => 'Fresh red apple picked from nearby farm',
                    'base_price' => 7.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 5.99,
                ]
            ],
            '2' => [
                [
                    'title' => 'Long Pants',
                    'description' => 'Long long paaaaaants',
                    'base_price' => 39.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 35.99,
                ],
                [
                    'title' => 'Long Sleeve Shirt',
                    'description' => 'Long long shirrrrrtttt',
                    'base_price' => 49.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 42.99,
                ],
                [
                    'title' => 'Belt',
                    'description' => 'This is a belt for your pants',
                    'base_price' => 10.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 9.99,
                ],
                [
                    'title' => 'Socks',
                    'description' => 'Fresh socks right out of the dryer',
                    'base_price' => 6.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 3.99,
                ]
            ],
            '3' => [
                [
                    'title' => 'Single Couch',
                    'description' => 'aaaaahhh after a long day of work',
                    'base_price' => 399.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 380.00,
                ],
                [
                    'title' => 'L-Sofa',
                    'description' => 'This is just for the rich ya',
                    'base_price' => 2449.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 1999.99,
                ],
                [
                    'title' => 'Dining Table',
                    'description' => 'Home is where the best meal ever served',
                    'base_price' => 1399.99,
                    'discount_type_for_member' => 'fixed',
                    'discounted_rate_for_member' => null,
                    'discounted_price_for_member' => 999.99,
                ],
            ],
        ];
        $categories = Category::all();
        foreach ($categories as $category)
        {
            $products = $productSeeds[$category->id];

            foreach ($products as $product)
            {
                $product['category_id'] = $category->id;
                Product::create($product);
            }
        }
    }
}
