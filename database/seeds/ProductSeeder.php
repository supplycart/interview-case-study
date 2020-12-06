<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Price;

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
        array('id' => 1, 'name'=>'Amazing Dog Shampoo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2, 'name'=>'IFruit 12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3, 'name'=>'12 Inch Gearbox', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4, 'name'=>'Microsoft Office Key', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5, 'name'=>'Chicken Stock', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Product::insert($data);

      $data = array(
        array('id' => 1, 'product_id'=> 1, 'amount' => 10.00 ,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2, 'product_id'=> 2, 'amount' => 15.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3, 'product_id'=> 3, 'amount' => 12.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4, 'product_id'=> 4, 'amount' => 11.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5, 'product_id'=> 5, 'amount' => 17.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Price::insert($data);
    }
}
