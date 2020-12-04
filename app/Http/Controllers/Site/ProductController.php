<?php

namespace App\Http\Controllers\Site;

use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Cart;

/**
 * Class ProductController
 * @package App\Http\Controllers
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

class ProductController extends BaseController
{
    protected $productRepository;
    protected $attributeRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);

        return view('site.pages.product', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'price', 'quantity');

        if($product) {
            Cart::add(uniqid(), $product->getName(), $request->input('price'), $request->input('quantity'), $options);
            $product->quantity = $product->getQuantity() - $request->input('quantity');
            $product->save();
            return $this->responseRedirectBack('Item added to cart successfully', 'success', true, true);
        }

        return $this->responseRedirectBack('Item not added to cart', 'success', true, true);
    }
}
