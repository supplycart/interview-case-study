<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'High-end',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 2,
                'name' => 'Mid-range',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
            [
                'id' => 3,
                'name' => 'Low-end',
                'created_at' => '2020-10-18 15:00:00',
                'updated_at' => '2020-10-18 15:00:00',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
