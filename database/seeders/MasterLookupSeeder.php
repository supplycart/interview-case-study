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
            [
                'type'        => 'order_status',
                'value'       => 'pending',
                'description' => 'Order is pending',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'order_status',
                'value'       => 'processing',
                'description' => 'Order is processing',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'order_status',
                'value'       => 'completed',
                'description' => 'Order is completed',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'order_status',
                'value'       => 'cancelled',
                'description' => 'Order is cancelled',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'payment_status',
                'value'       => 'pending',
                'description' => 'Payment is pending',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'payment_status',
                'value'       => 'paid',
                'description' => 'Payment is paid',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'type'        => 'payment_status',
                'value'       => 'failed',
                'description' => 'Payment is failed',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        \DB::table('master_lookups')->insert($data);
    }
}
