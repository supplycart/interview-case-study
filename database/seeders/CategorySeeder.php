<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(['name' => 'Furniture']);
        DB::table('categories')->insert(['name' => 'Homeware']);
        DB::table('categories')->insert(['name' => 'Women']);
        DB::table('categories')->insert(['name' => 'Men']);
        DB::table('categories')->insert(['name' => 'Kids']);
        DB::table('categories')->insert(['name' => 'Stationary']);
        DB::table('categories')->insert(['name' => 'Beauty']);
        DB::table('categories')->insert(['name' => 'Travel']);
        DB::table('categories')->insert(['name' => 'Food']);
        DB::table('categories')->insert(['name' => 'Sale']);
        DB::table('categories')->insert(['name' => 'Sustainability']);
    }
}
