<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [ 'id' => 1, 'name' => "Meja", 'price'=> 20],
            [ 'id' => 2, 'name' => "Almari", 'price'=> 30],
            [ 'id' => 3, 'name' => "Kerusi", 'price'=> 40],
            [ 'id' => 4, 'name' => "Katil", 'price'=> 50],
            [ 'id' => 5, 'name' => "Rak Kasut", 'price'=> 60],  
        ];

        foreach($seeds as $seed) {
            DB::table('products')->insert($seed);
        }
    }
}
