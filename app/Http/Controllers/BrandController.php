<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response()->json([
            "brands" => Brand::all(),
        ]);
    }

    public function show($id)
    {
        $brand = Brand::find($id);

        if (!$brand) 
        {
            return response()->json([
                'error' => 404,
                'message' => 'Not Found'
            ], 404);
        }

        return response()->json([
            'brand' => $brand
        ],200);
    }
}
