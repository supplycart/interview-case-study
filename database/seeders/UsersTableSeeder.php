<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'Special',
            'email'             => 'special@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('password'),
            'is_special'        => true,
        ]);

        DB::table('users')->insert([
            'name'              => 'Normal',
            'email'             => 'normal@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('password'),
            'is_special'        => false,
        ]);
    }
}
