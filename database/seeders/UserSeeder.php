<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'user@dummy.com'],
            [
                'name'     => 'user',
                'email'    => 'user@email.com',
                'password' => bcrypt('user123'),
            ]
        );
    }
}
