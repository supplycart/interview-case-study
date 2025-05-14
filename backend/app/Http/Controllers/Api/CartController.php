<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartController\StoreRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Activitylog\Facades\LogBatch;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        return $this->respond(message: 'Get cart successful.', data: new CartResource(getUserCart()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        /** @var Cart $cart */
        $cart = getUserCart();
        $validated = $request->validated();

        LogBatch::startBatch();
        activity('cart')->on($cart)->log('updated');
        $updateOrCreateProductIds = [];
        foreach ($validated as $item) {
            $updateOrCreateProductIds[] = $item['product_id'];
            CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'product_id' => $item['product_id']],
                ['quantity' => $item['quantity']],
            );
        }
        $cartItemsToDelete = CartItem::where('cart_id', $cart->id)
            ->whereNotIn('product_id', $updateOrCreateProductIds)
            ->get();
        if ($cartItemsToDelete->isNotEmpty()) {
            foreach ($cartItemsToDelete as $cartItem) {
                $cartItem->delete();
            }
        }
        LogBatch::endBatch();
        $cart->touch();

        return $this->respond(message: 'Update cart successful.', data: new CartResource(getUserCart()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
