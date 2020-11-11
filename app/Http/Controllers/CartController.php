<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    //
    public function addProduct($user_id, $product_id){
    	$product = DB::table('product')
    					->select('unit_price')
    					->where('id','=',$product_id)
    					->get();

    }
}
