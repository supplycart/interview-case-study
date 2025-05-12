<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAndCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $created_at = now();
        $updated_at = now();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Hazim MY',
                'email' => 'hazim.hadis+my@gmail.com',
                'password' => bcrypt('password'),
                'country_id' => Country::where('countries.code', 'MY')->first()->id,
                'email_verified_at' => now(),
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
            [
                'id' => 2,
                'name' => 'Hazim ID',
                'email' => 'hazim.hadis+id@gmail.com',
                'password' => bcrypt('password'),
                'country_id' => Country::where('countries.code', 'ID')->first()->id,
                'email_verified_at' => now(),
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
        ]);

        DB::table('carts')->insert([
            ['id' => 1, 'user_id' => 1, 'created_at' => $created_at, 'updated_at' => $updated_at],
            ['id' => 2, 'user_id' => 2, 'created_at' => $created_at, 'updated_at' => $updated_at],
        ]);
    }
}
