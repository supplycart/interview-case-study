<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Ahmad Zali Bin Jamil',
            'email' => 'zali@yahoo.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ]);
    }
}
