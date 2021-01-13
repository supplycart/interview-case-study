<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Class ProductController
 * @package App\Http\Controllers
 * @mixin Product
 */
class ProductController extends Controller
{
    public function index()
    {
        $productsList = Product::all()->take(5);
        //$finalProductsList = json_encode($productsList);
        print_r( response()->json($productsList) );

        return response()->json($productsList);
        //return Inertia::render('Dashboard')->with('productsList', $finalProductsList);
        //return Inertia::render('Dashboard')->with(response()->json($productsList)->getData());
    }
}
