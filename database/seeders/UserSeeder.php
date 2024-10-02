<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Basic',
            'email' => 'basic@supplycart.azushi.com',
            'password' => 'basic',
            'user_tier' => 'basic',
        ]);

        User::factory()->create([
            'name' => 'Silver',
            'email' => 'silver@supplycart.azushi.com',
            'password' => 'silver',
            'user_tier' => 'silver',
        ]);

        User::factory()->create([
            'name' => 'Gold',
            'email' => 'gold@supplycart.azushi.com',
            'password' => 'gold',
            'user_tier' => 'gold',
        ]);

        User::factory()->create([
            'name' => 'Platinum',
            'email' => 'platinum@supplycart.azushi.com',
            'password' => 'platinum',
            'user_tier' => 'platinum',
        ]);
    }
}
