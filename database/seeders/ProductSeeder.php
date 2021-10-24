<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('products')->insert([
            [
                'brand' => 'zotac',
                'name' => 'ZOTAC GAMING GeForce RTX 3070 Ti AMP Holo',
                'price' => '4699.00',
                'image' => 'zotac-3070ti.jpg',
                'created_at' => '2021-10-24 16:00:00',
                'updated_at' => '2021-10-24 16:00:00'
            ],
            [
                'brand' => 'rog',
                'name' => 'ROG-STRIX-RTX3060-O12G-GAMING',
                'price' => '3699.00',
                'image' => 'rog-3060.png',
                'created_at' => '2021-10-24 16:00:00',
                'updated_at' => '2021-10-24 16:00:00'
            ],
            [
                'brand' => 'zotac',
                'name' => 'ZOTAC GAMING GeForce RTX 3080 Trinity',
                'price' => '5899.00',
                'image' => 'zotac-3080.jpg',
                'created_at' => '2021-10-24 16:00:00',
                'updated_at' => '2021-10-24 16:00:00'
            ],
            [
                'brand' => 'msi',
                'name' => 'MSI GeForce RTX™ 3080 GAMING X TRIO 10G',
                'price' => '6599.00',
                'image' => 'msi-3080.png',
                'created_at' => '2021-10-24 16:00:00',
                'updated_at' => '2021-10-24 16:00:00'
            ],

        ]);
    }
}
