<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Padini'],
            ['name' => 'Uniqlo'],
            ['name' => 'FIXI'],
            ['name' => 'Kinokuniya'],
            // Add other brands as needed
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
