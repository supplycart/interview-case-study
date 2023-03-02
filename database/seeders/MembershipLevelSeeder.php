<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MembershipLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Silver',
                'discount' => '5.00',
                'text_color' => '#000000',
                'bg_color' => '#EDE9E9'
            ],
            [
                'name' => 'Gold',
                'discount' => '10.00',
                'text_color' => '#000000',
                'bg_color' => '#ffd700'
            ],
            [
                'name' => 'Platinum',
                'discount' => '15.00',
                'text_color' => '#000000',
                'bg_color' => '#EAFAFD'
            ],
        ];

        DB::table('membership_levels')->insert($data);
    }
}
