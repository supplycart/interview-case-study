<?php

namespace App\Http\Controllers;

use App\Actions\AddToCartAction;
use App\Http\Requests\AddToCartRequest;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function store(AddToCartRequest $request, AddToCartAction $action)
    {
        try {
            $action->execute(
                $request->validated('product_id'),
                $request->validated('quantity')
            );

            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
