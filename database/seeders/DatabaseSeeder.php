<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [];

        if (App::environment('local')) {
            $seeders[] = DevCategorySeeder::class;
            $seeders[] = DevProductSeeder::class;
            $seeders[] = DevUserSeeder::class;
        }

        $this->call($seeders);

    }
}
