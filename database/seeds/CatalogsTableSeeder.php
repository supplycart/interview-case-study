<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Catalog;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->truncate();
        DB::table('catalogs')->insert([
            [
                'name' => 'Appliances',
                'image' => 'appliances_cat.jpg',
                'description' => 'Discover a variety of home appliances and electrical..',
                'parent_id' => NULL,
                'priority' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Furniture',
                'image' => 'furniture_cat.jpg',
                'description' => 'Buy the latest Furniture at the best prices at Supplycart..',
                'parent_id' => NULL,
                'priority' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Food',
                'image' => 'food_cat.jpg',
                'description' => 'Snacks? Bytes? Get it all in..',
                'parent_id' => NULL,
                'priority' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Women Fashion',
                'image' => 'jewelry_cat.jpg',
                'description' => 'Shop the Latest Collections & Deals',
                'parent_id' => NULL,
                'priority' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
        $parent_id = Catalog::where('name', 'Appliances')->first()->id;
        DB::table('catalogs')->insert([
            [
                'name' => 'Samsung 16K LED TV',
                'image' => 'tv_cat.jpg',
                'description' => '100 inch 16K LED TV',
                'parent_id' => $parent_id,
                'priority' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Midea Refrigerator',
                'image' => 'refrigerators_cat.jpg',
                'description' => 'Midea 3 door 725L Refrigerator',
                'parent_id' => $parent_id,
                'priority' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Apple iPhone 21 Pro Max',
                'image' => 'cellphones_cat.jpg',
                'description' => 'iPhone 21 Pro Max 512TB',
                'parent_id' => $parent_id,
                'priority' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

        $parent_id = Catalog::where('name', 'Furniture')->first()->id;

        DB::table('catalogs')->insert([
            [
                'name' => 'Kazuki Sofa',
                'image' => 'sofas_cat.jpg',
                'description' => 'KAZUKI 16 Seater Foldable Sofa Bed',
                'parent_id' => $parent_id,
                'priority' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jati Cupboard',
                'image' => 'cupboards_cat.jpg',
                'description' => 'Free installation. :)',
                'parent_id' => $parent_id,
                'priority' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Purple Mattress',
                'image' => 'beds_cat.jpg',
                'description' => 'Purple hyper-elastic polymer grid is said to provide greater airflow and..',
                'parent_id' => $parent_id,
                'priority' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

        $parent_id = Catalog::where('name', 'Food')->first()->id;

        DB::table('catalogs')->insert([
            [
                'name' => 'Milk',
                'image' => 'milk_cat.jpg',
                'description' => 'For office? For cat? We got it all!',
                'parent_id' => $parent_id,
                'priority' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bread',
                'image' => 'bread_cat.jpg',
                'description' => 'French will lose with our bread ezpz',
                'parent_id' => $parent_id,
                'priority' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sweets',
                'image' => 'sweets_cat.jpg',
                'description' => 'So sweet no girl will be forever angry',
                'parent_id' => $parent_id,
                'priority' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
        $parent_id = Catalog::where('name', 'Women Fashion')->first()->id;
        DB::table('catalogs')->insert([
            [
                'name' => 'Victoria Secret la eau de toilette',
                'image' => 'lcd_cat.jpg',
                'description' => 'Shh! Secret..',
                'parent_id' => $parent_id,
                'priority' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => '24K carat gold lipstick',
                'image' => 'plasma_cat.jpg',
                'description' => 'Feel kaching kaching',
                'parent_id' => $parent_id,
                'priority' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Hermes Bag',
                'image' => 'led_tv_cat.jpg',
                'description' => 'Dreamy? Yes it is!',
                'parent_id' => $parent_id,
                'priority' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
