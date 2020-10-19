<?php

namespace App\Http\Controllers\API\Product;

use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $successStatus = 200;
    public function __construct(ProductContract $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(['data' => $this->product->getAll($request)], $this->successStatus);
    }
}
