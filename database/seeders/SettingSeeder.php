<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'tax_percentage', 'value' => '6'],
            ['key' => 'shipping_fee_currency', 'value' => 'MYR'],
            ['key' => 'shipping_fee_price', 'value' => '10'],
        ];

        DB::table('settings')->insert($data);
    }
}
