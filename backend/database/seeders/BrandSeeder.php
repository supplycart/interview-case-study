<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Honda'],
            ['name' => 'Kawasaki'],
            ['name' => 'Suzuki'],
            ['name' => 'Yamaha'],
        ]);
    }
}
