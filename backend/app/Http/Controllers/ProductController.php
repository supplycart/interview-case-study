<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function index()
    {
        Log::channel('syslog')->info('List of available product are returned');

        $output = new ProductCollection(Product::all());

        return response($output)->setStatusCode(200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::channel('syslog')->info('Product '. $id . ' detail is requested');

        $product =  Product::firstWhere('ProductId', $id);
         return new ProductResource($product); // transform into JSON

    }
}
