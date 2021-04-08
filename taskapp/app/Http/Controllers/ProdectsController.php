<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProdectsController extends Controller
{
    // This method get all product form data base 

    public function getIndex()
    {
        $allproduct=DB::table('products')->get();
    
        //return $allproduct;
        return view('products',['allproduct'=>$allproduct]);
        
        
    }
}
