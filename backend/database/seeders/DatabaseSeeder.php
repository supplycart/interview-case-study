<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class, // Seed categories first
            BrandSeeder::class,    // Seed brands
            AttributeSeeder::class, // Seed attributes first
            AttributeValueSeeder::class, // Then attribute values
            ProductSeeder::class, // Then products
            ProductAttributeValueSeeder::class, // Link products and attribute values
            UserProductPriceSeeder::class, // Link users and products with custom prices
        ]);
    }
}
