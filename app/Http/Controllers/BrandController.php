<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "data" => Brand::all(),
        ]);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if(!$brand) throw new ModelNotFoundException;

        return response()->json([
            'brand' => $brand
        ],200);
    }
}
