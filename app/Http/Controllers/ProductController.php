<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::when($request->query('name'), function($query) use ($request) {
        //         return $query->where('name', 'like', '%'.$request->query('name').'%');
        //     })
        //     ->when($request->query('description'), function($query) use ($request) {
        //         return $query->where('description', 'like','%'.$request->query('description').'%');
        //     })
        //     ->get();
        
        return response()->json([
            'products' => Product::all()
        ],200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'error' => 404,
                'message' => 'Not Found'
            ], 404);
        }

        return response()->json([
            'product' => $product
        ],200);
    }
}
