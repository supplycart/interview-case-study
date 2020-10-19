<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'id' => 1,
                'name' => 'Nestle',
            ],

            [
                'id' => 2,
                'name' => 'Power Root',
            ],

            [
                'id' => 3,
                'name' => 'Samyang',
            ]
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate($brand);
        }
    }
}
