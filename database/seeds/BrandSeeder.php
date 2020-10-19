<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'id' => 1,
                'name' => 'Samsung',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 2,
                'name' => 'Apple',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 3,
                'name' => 'Xiaomi',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
        ];

        DB::table('brands')->insert($brands);
    }
}
