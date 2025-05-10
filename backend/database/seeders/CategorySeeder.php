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
            ['name' => 'Moped'],
            ['name' => 'Scooter'],
            ['name' => 'Sport'],
            ['name' => 'Street'],
            ['name' => 'Touring'],
        ]);
    }
}
