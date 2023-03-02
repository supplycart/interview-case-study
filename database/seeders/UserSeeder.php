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
                'password' => Hash::make(11111111),
                'membership_level_id' => 1
            ],
            [
                'name' => 'Mary Jane',
                'email' => 'gold@gmail.com',
                'password' => Hash::make(11111111),
                'membership_level_id' => 2
            ],
            [
                'name' => 'James Bond',
                'email' => 'platinum@gmail.com',
                'password' => Hash::make(11111111),
                'membership_level_id' => 3
            ]
        ]);
    }
}
