<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductAndPriceSeeder::class,
        ]);

        if (in_array(config('app.env'), ['local', 'testing'])) {
            $this->call([
                UserSeeder::class,
                CartAndOrderSeeder::class,
            ]);
        }

        Artisan::call('passport:client --password --name=SupplyCart --provider=users');
        print(Artisan::output());
    }
}
