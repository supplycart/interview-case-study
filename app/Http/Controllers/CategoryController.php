<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
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
        return response()->json([
            "categories" => Category::all(),
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if(!$category) throw new ModelNotFoundException;

        return response()->json([
            'category' => $category
        ],200);
    }
}
