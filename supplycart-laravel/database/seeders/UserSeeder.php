<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Test123#'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => 'Test123#'
        ]);
    }
}
