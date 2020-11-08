<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) {
            $faker = Faker::create();
            DB::table('products')->insert([
                'name' => 'Product '.$i,
                'descriptions' => $faker->sentence(5),
                'quantity' => rand(1,100),
                'price' => rand(100,1000),
                'image' =>  asset('product_default'),
                'category' => Arr::random(['phone-tablets','computing']),
                'brand' => Arr::random(['Sony','Apple','Samsung']),
            ]);
        }
       
    }
}
