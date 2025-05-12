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
            ['id' => 1, 'name' => 'Honda'],
            ['id' => 2, 'name' => 'Kawasaki'],
            ['id' => 3, 'name' => 'Suzuki'],
            ['id' => 4, 'name' => 'Yamaha'],
        ]);
    }
}
