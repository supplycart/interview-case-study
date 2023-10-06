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
        $data = [
            [
                'name' => 'Uniqlox',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna. Cras viverra metus arcu, in tincidunt eros aliquet id. Donec dui lorem, iaculis a lacus ut, bibendum congue odio.',
            ],
            [
                'name' => 'OxBlack',
                'description' => 'Praesent scelerisque feugiat rhoncus. Phasellus rhoncus urna eget sem pellentesque, vel rhoncus dolor ornare. Donec eleifend est enim, interdum porta ex pulvinar nec.',
            ],
            [
                'name' => 'H&G',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna. Cras viverra metus arcu, in tincidunt eros aliquet id. Donec dui lorem, iaculis a lacus ut, bibendum congue odio.',
            ],
            [
                'name' => 'ZAPA',
                'description' => 'Praesent scelerisque feugiat rhoncus. Phasellus rhoncus urna eget sem pellentesque, vel rhoncus dolor ornare. Donec eleifend est enim, interdum porta ex pulvinar nec.',
            ],
            [
                'name' => 'Noto',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu accumsan magna. Cras viverra metus arcu, in tincidunt eros aliquet id. Donec dui lorem, iaculis a lacus ut, bibendum congue odio.',
            ],
        ];

        Brand::insert($data);
    }
}
