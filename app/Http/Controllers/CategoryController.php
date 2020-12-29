<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response()->json([
            "categories" => Category::all(),
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) 
        {
            return response()->json([
                'error' => 404,
                'message' => 'Not Found'
            ], 404);
        }

        return response()->json([
            'category' => $category
        ],200);
    }
}
