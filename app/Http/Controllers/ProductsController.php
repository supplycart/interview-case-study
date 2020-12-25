<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\UserOrder;
use App\Services\ProductService;
use App\Category;
use Auth;

class ProductsController extends Controller
{       
    public function index(Request $request)
    {
        $userId = Auth::user()->id;         
        $products = ProductService::getFilteredProducts($request);           
        $pendingOrdersCount = count(UserOrder::where([
            ['user_id', '=', $userId],            
            ['is_fulfilled', '=', false]
        ])->get());
        $categories = Category::all();
        
        $data = [ 
            'products' => $products,
            'pendingOrdersCount' => $pendingOrdersCount,
            'categories' => $categories,
        ];

        activity()                                        
            ->log('view all products');

        // return $products[0];
        return view('products.index')->with($data);
    }     
}
