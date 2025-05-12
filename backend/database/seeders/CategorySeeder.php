<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Moped'],
            ['id' => 2, 'name' => 'Scooter'],
            ['id' => 3, 'name' => 'Sport'],
            ['id' => 4, 'name' => 'Street'],
            ['id' => 5, 'name' => 'Touring'],
        ]);
    }
}
