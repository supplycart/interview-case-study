<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = array(
        array('name'=>'Amazing Dog Shampoo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'IFruit 12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'12 Inch Gearbox', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Microsoft Office Key', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Chicken Stock', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Product::insert($data);
    }
}
