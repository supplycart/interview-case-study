<?php

namespace App\Http\Controllers;

use App\Actions\Carts\AddToCartAction;
use App\Actions\Carts\DeleteItemFromCartAction;
use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Cart/Index', [
            'cartItems' => $request->user()->carts()->with('product.image')->get()
        ]);
    }

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

    public function destroy(int $productId, DeleteItemFromCartAction $action)
    {
        $action->execute($productId);

        return response()->noContent();
    }
}
