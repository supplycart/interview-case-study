<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;

class ProductController extends BaseController
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts()
    {
        return $this->productRepository->listProducts();
    }

    public function getProductDetail($slug)
    {
        return $this->responseJson(false, 200, 'Retrieve Product detail successful', $this->productRepository->findProductBySlug($slug));
    }
}
