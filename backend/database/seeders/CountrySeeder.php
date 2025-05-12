<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'Malaysia', 'code' => 'MY', 'currency' => 'MYR', 'tax_name' => 'SST', 'tax_rate' => 8],
            ['id' => 2, 'name' => 'Singapore', 'code' => 'SG', 'currency' => 'SGD', 'tax_name' => 'GST', 'tax_rate' => 9],
            ['id' => 3, 'name' => 'Indonesia', 'code' => 'ID', 'currency' => 'IDR', 'tax_name' => 'VAT', 'tax_rate' => 11],
            ['id' => 4, 'name' => 'Thailand', 'code' => 'TH', 'currency' => 'THB', 'tax_name' => 'VAT', 'tax_rate' => 7],
        ]);
    }
}
