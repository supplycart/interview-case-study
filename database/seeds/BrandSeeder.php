<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\ProductBrand;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = array(
        array('id' => 1, 'name'=>'Engineethic', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2, 'name'=>'Instanttouch', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3, 'name'=>'Cookingwizard', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4, 'name'=>'Softadapt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5, 'name'=>'Petyield', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Brand::insert($data);

      $data = array(
        array('id' => 1, 'product_id'=> 1, 'brand_id'=> 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2, 'product_id'=> 2, 'brand_id'=> 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3, 'product_id'=> 3, 'brand_id'=> 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4, 'product_id'=> 4, 'brand_id'=> 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5, 'product_id'=> 5, 'brand_id'=> 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      ProductBrand::insert($data);
    }
}
