<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
    //
    public function getCategory(Request $request){
    	$product_arr = DB::table('product')
    						->join('brand', 'product.brand_id', '=', 'brand.id')
    						->join('category', 'product.category_id', '=', 'category.id')
    						->select('product.id','product.name as product_name','brand.name as brand_name','category.name as category_name','product.description','product.unit','product.unit_price')
    						->where('category.id','=',$request->id)
    						->get();

    	return json_encode($product_arr);
    }
}
