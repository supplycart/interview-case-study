<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Country;
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
        $this->call([
            CountrySeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            UserAndCartSeeder::class,
            ProductAndPriceSeeder::class,
        ]);

        Artisan::call('passport:client --password --name=SupplyCart --provider=users');
        print(Artisan::output());
    }
}
