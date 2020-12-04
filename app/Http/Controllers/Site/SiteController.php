<?php

namespace App\Http\Controllers\site;

use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SiteController extends BaseController
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        //$this->middleware(['auth','verified']);
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $products = $this->productRepository->listProducts();
        return view('site.pages.index', compact('products'));
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);

        return view('site.pages.product', compact('product'));
    }
}
