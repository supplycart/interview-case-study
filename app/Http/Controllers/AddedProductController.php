<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddedProductCreateRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\PreviousOrderResource;
use App\Models\AddedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AddedProductController extends Controller
{
    public function index(Request $request)
    {
        return CartResource::collection(AddedProduct::index(false)->with(['price'])->get());
    }

    public function store(AddedProductCreateRequest $request)
    {
        return auth()->user()->addedProducts()->create($request->validated());
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
