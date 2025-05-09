<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Hazim',
            'email' => 'hazim.hadis@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Artisan::call('passport:client --password --name=SupplyCart --provider=users');
        print(Artisan::output());
    }
}
