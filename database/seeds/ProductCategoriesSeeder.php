<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_1 = Product::first();
        $product_2 = Product::orderby('id', 'desc')->first();
        $category_1 = Category::first();
        $category_2 = Category::orderby('id', 'desc')->first();
        
        DB::table('product_categories')->insert([
            [
                'product_id' => $product_1->id,
                'category_id' => $category_1->id,                       
            ],            
            [
                'product_id' => $product_2->id,
                'category_id' => $category_2->id,                  
            ]
        ]);
    }
}
