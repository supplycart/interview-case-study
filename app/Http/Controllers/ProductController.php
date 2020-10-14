<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $product_query = Product::query();
        if ($request->has('query')) {
            $query = $request->input('query');
            $product_query->where('name', 'like', "%$query%")
            ->orWhere('type', 'like', "%$query%");
        }
        $products = $product_query->get();
        return response($products, 200);
    }

}
