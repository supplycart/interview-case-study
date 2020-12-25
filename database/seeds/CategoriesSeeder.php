<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Categories')->insert([
            [
                'name' => 'watch',                           
            ],            
            [
                'name' => 'accessory',                        
            ]
        ]);
    }
}
