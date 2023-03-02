<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'silver@gmail.com',
                'email_verified_at' => '2023-03-03 00:00:00',
                'password' => Hash::make(11111111),
                'membership_level_id' => 1
            ],
            [
                'name' => 'Mary Jane',
                'email' => 'gold@gmail.com',
                'email_verified_at' => '2023-03-03 00:00:00',
                'password' => Hash::make(11111111),
                'membership_level_id' => 2
            ],
            [
                'name' => 'James Bond',
                'email' => 'platinum@gmail.com',
                'email_verified_at' => '2023-03-03 00:00:00',
                'password' => Hash::make(11111111),
                'membership_level_id' => 3
            ]
        ]);
    }
}
