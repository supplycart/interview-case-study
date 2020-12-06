<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ProductCategory;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = array(
        array('id' => 1,'name'=>'Pet', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2,'name'=>'Electronics', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3,'name'=>'Mechanical', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4,'name'=>'Software', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5,'name'=>'Cooking', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Category::insert($data);

      $data = array(
        array('id' => 1, 'product_id'=> 1, 'category_id'=> 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 2, 'product_id'=> 2, 'category_id'=> 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 3, 'product_id'=> 3, 'category_id'=> 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 4, 'product_id'=> 4, 'category_id'=> 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('id' => 5, 'product_id'=> 5, 'category_id'=> 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      ProductCategory::insert($data);
    }
}
