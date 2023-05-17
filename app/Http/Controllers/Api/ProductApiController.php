<?php

namespace App\Http\Controllers\Api;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends ApiController
{
    protected $product;

    function __construct(ProductService $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $results = $this->product->list($request->all());

        return $this->formatResponse($results);
    }

    public function store(Request $request)
    {
        $results = $this->product->addToCart($request->all());
        
        return $this->formatResponse($results);
    }

    public function show($id)
    {
        $results = $this->product->show($id);

        return $this->formatResponse($results);
    }

    public function brand()
    {
        $results = $this->product->brand();

        return $this->formatResponse($results);
    }

    public function category()
    {
        $results = $this->product->category();

        return $this->formatResponse($results);
    }
}
