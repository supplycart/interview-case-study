<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;
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
        array('name'=>'Engineethic', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Instanttouch', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Cookingwizard', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Softadapt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        array('name'=>'Petyield', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
      );
      
      Brand::insert($data);
    }
}
