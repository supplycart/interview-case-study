<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::create([
            'name' => 'Sensodyne',
        ]);
        Brand::create([
            'name' => 'Murni',
        ]);
        Brand::create([
            'name' => 'Maggi',
        ]);
        Brand::create([
            'name' => 'Ayam\'s Brand',
        ]);
        Brand::create([
            'name' => 'Life',
        ]);
    }
}
