<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
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
        array('name'=>'Pet', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Electronics', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Mechanical', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Software', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Cooking', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Category::insert($data);
    }
}
