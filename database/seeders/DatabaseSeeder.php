<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ProductSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([   
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            GoodSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
