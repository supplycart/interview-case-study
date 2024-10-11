<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Add some sample brands
        $brands = ['Apple', 'Samsung', 'Sony', 'LG', 'Dell'];

        foreach ($brands as $brand) {
            Brand::create(['name' => $brand]);
        }
    }
}
