<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($x = 0; $x < 11; $x++) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'type' => $faker->safeColorName ,
                'price' =>  rand ( 10, 50),
                'member_price' => '1',
                'image_src' => 'https://i.insider.com/4fe4946d69bedd5d23000000?width=300&format=jpeg&auto=webp'
            ]);
        }
    }
}
