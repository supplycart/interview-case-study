<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'type'        => 'product_status',
                'value'       => 'active',
                'description' => 'Active',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'product_status',
                'value'       => 'inactive',
                'description' => 'Inactive',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        \DB::table('master_lookups')->insert($data);
    }
}
