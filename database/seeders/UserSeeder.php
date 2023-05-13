<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Siti',
                'email' => 'siti@email.com',
                'password' => Hash::make('password@123'),
                'is_admin' => true,
                'discount' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Farah',
                'email' => 'farah@email.com',
                'password' => Hash::make('password@123'),
                'is_admin' => false,
                'discount' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Aina',
                'email' => 'aina@email.com',
                'password' => Hash::make('password@123'),
                'is_admin' => false,
                'discount' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        User::insert($user);
    }
}
