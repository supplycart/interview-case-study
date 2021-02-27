<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductService $productService, Request $request)
    {
        //
        return $productService->getProducts($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductService $productService, Request $request)
    {
        //
        return $productService->getProduct($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCart(ProductService $productService, Request $request)
    {
        return $productService->getCart($request);
    }

    public function postCheckout(ProductService $productService, UserService $userService, OrderService $orderService, Request $request)
    {
        $validator = $productService->validateCheckout($request->all());
        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }
        try {
            $user = $userService->getUserForCheckout($request);
            $pizzas = $productService->getProductsForCheckout($request);
            if (!$pizzas)
                return [ 'success' => false ];

            $orderService->newOrder()->calculateSubtotal($request, $pizzas)->fillOrder($request, $user)->generateOrderItems($request, $pizzas);
            return [ 'success' => true ];

        } catch (Exception $e) {
            return [ 'success' => false ];
        }
    }
}
