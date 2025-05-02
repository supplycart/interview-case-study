<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['code' => 'bakery', 'name' => 'Bakery', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'cooking', 'name' => 'Cooking', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'meat', 'name' => 'Meat', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'biscuits', 'name' => 'Biscuits', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
