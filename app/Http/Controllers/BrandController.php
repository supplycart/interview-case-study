<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    //

    public function getBrand(Request $request){
    	$brand = DB::table('brand')
    						->select('name')
    						->where('id','=',$request->id)
    						->get();

    	return json_encode($brand);
    }

    
}
