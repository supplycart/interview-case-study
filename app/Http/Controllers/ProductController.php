<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::all();
        if(in_array('Member',Auth::user()->getRoleNames()->toArray())){
            foreach($product as $products){
                $products->price = 'RM'.number_format(floatval(str_replace("RM","",$products->price)) * 0.8);
            }
        }
        return view('product',compact('product'));
    }

    /**
     * Show the sorted product.
     *
     * @return Array
     */
    public function sort($option=null,$value=null)
    {
        if($option!=null && $value!=null){
            $product = Product::orderBy($option,$value)->get();
            if(in_array('Member',Auth::user()->getRoleNames()->toArray())){
                foreach($product as $products){
                    $products->price = 'RM'.number_format(floatval(str_replace("RM","",$products->price)) * 0.8);
                }
            }
        }
        return view('product',compact('product'));
    }
}
