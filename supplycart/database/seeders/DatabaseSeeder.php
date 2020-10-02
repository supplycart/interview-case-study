<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Products;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Table',
                'description' => 'A Wooden Table',
                'brand' => 'Woody',
                'price' => 5.50
            ],
            [
                'name' => 'Chair',
                'description' => 'A Wooden Chair',
                'brand' => 'Woody',
                'price' => 3.50
            ],
            [
                'name' => 'Cabinet',
                'description' => 'A Wooden Cabinet',
                'brand' => 'Woody',
                'price' => 25.00
            ],
            [
                'name' => 'Ladder',
                'description' => 'A Tall Ladder',
                'brand' => 'Steely',
                'price' => 2.00
            ],
            [
                'name' => 'Steel Chair',
                'description' => 'A Steel Chair',
                'brand' => 'Steely',
                'price' => 7.00
            ],
            [
                'name' => 'Steel Table',
                'description' => 'A Steel Table',
                'brand' => 'Steely',
                'price' => 9.20
            ],
        ];

        \App\Models\User::factory(10)->create();

        foreach ($products as $product) {
            Products::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'brand' => $product['brand'],
                'price' => $product['price']
            ]);
        }
        
            

    }
}
