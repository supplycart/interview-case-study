<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['code' => 'bismi', 'name' => 'Bismi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'adabi', 'name' => 'Adabi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'gardenia', 'name' => 'Gardenia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'ramly', 'name' => 'Ramly', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'julies', 'name' => 'Julies', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('brands')->insert($brands);
    }
}
