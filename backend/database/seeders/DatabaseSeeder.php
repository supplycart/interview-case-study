<?php

namespace Database\Seeders;

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
            ProductAndPriceSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Hazim',
            'email' => 'hazim.hadis+my@gmail.com',
            'password' => bcrypt('password'),
            'country_id' => Country::where('countries.code', 'MY')->first()->id,
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Hazim',
            'email' => 'hazim.hadis+id@gmail.com',
            'password' => bcrypt('password'),
            'country_id' => Country::where('countries.code', 'ID')->first()->id,
            'email_verified_at' => now(),
        ]);

        Artisan::call('passport:client --password --name=SupplyCart --provider=users');
        print(Artisan::output());
    }
}
