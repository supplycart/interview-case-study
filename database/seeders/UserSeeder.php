<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhamad Taufiq',
            'email' => 'fiq265@yahoo.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ]);
    }
}
