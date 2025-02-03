<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductBrand;

class ProductBrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Apple', 'Samsung', 'Sony', 'LG', 'Dell'];

        foreach ($brands as $brand) {
            ProductBrand::create(['name' => $brand]);
        }
    }
}
