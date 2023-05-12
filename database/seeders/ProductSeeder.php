<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = [
            [
                'name' => 'Blouse',
                'price' => 13,
                'image' => 'products/Oruun1CIDNpzixu9QQH8vEMaFX5Dos2CEjtTGDEU.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kebaya',
                'price' => 15,
                'image' => 'products/2dkfkkV4Ls5eWSo23k4Kwl3rLOKo2hpUuKOp5AJ5.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kurung Pahang',
                'price' => 11,
                'image' => 'products/OVaeo6nUK2DSUsfje7Br6do3dQOAOo5IZxdxwCUs.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kurung Moden',
                'price' => 12.90,
                'image' => 'products/zPlgEr1UY1eK7TXKROMPXOexJGG3I5FKa76szkX8.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        Product::insert($product);
    }
}
