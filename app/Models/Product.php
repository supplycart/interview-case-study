<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public static function getAllProducts(){
    	$product_arr = DB::table('product')
    						->join('brand', 'product.brand_id', '=', 'brand.id')
    						->join('category', 'product.category_id', '=', 'category.id')
    						->select('product.id','product.name as product_name','brand.name as brand_name','category.name as category_name','product.description','product.unit','product.unit_price')
    						->get();

    	return json_encode($product_arr);
    }
}
