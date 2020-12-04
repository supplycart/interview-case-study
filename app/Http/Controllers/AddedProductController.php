<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddedProductCreateRequest;
use App\Models\AddedProduct;
use Illuminate\Http\Request;

class AddedProductController extends Controller
{
    public function index()
    {
        return auth()->user()->addedProducts();
    }

    public function store(AddedProductCreateRequest $request)
    {
        return auth()->user()->create($request->validated());
    }

    public function show(AddedProduct $addedProduct)
    {
        //
    }

    public function update(AddedProductCreateRequest $request, AddedProduct $addedProduct)
    {
        return $addedProduct->update($request->validated());
    }

    public function destroy(AddedProduct $addedProduct)
    {
        $addedProduct->delete();
    }
}
