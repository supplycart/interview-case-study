<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Customer 1',
                'email' => 'customer_1@example.com',
                'password' => '12345678',
            ],
            [
                'name' => 'Customer 2',
                'email' => 'customer_2@example.com',
                'password' => '12345678',
            ],
            [
                'name' => 'Customer 3',
                'email' => 'customer_3@example.com',
                'password' => '12345678',
            ],
        ];

        $now = now();
        foreach ($users as $user) {
            User::firstOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'email_verified_at' => $now,
                    'password' => bcrypt($user['password']),
                ]
            );
        }
    }
}
