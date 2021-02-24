<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desc ='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua consequat.';  
        $products = [
            [
                'name' => "Nike Air Max Viva",
                'description' => $desc,
                'units' => 21,
                'price' => 589,
                'image' => 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/fc5e4df5-355a-49f2-b797-33591b686b64/air-max-viva-shoe-31Zblk.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Nike Air Max Verona SE",
                'description' => $desc,
                'units' => 400,
                'price' => 545,
                'image' => 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/40f49c58-8cdb-42e3-9090-d8f90ccee0d9/air-max-verona-se-shoe-47KtK8.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Nike Air Max 90",
                'description' => $desc,
                'units' => 37,
                'price' => 499,
                'image' => 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/69e8ecc4-99b8-4af7-ae4e-b91047b6355b/air-max-90-shoe-DxngKX.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => 'Nike Air Max 2090',
                'description' => $desc,
                'units' => 10,
                'price' => 589,
                'image' => 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/dbec1c09-bcab-436c-9100-c517e3d6ed5f/air-max-2090-shoe-lRFWrB.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
        ];

        DB::table('products')->insert($products);
    }
}
