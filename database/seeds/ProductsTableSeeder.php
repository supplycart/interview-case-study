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
        for ($x = 0; $x <= 10; $x++) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'type' => rand ( 1, 5) ,
                'price' =>  rand ( 10, 50),
                'image_src' => $faker->imageUrl()
            ]);
        }
    }
}
