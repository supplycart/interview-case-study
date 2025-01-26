<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Exception;

class CartController extends Controller
{
    protected $cartService;
    protected $orderService;

    public function __construct(CartService $cartService,OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    /**
     * get the cart items count.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countCartItems(Request $request)
    {
        try {
            $count = $this->cartService->countTotalItems();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['count' => $count]);
    }

    /**
     * Add items to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $productId = $request->id;

        try {
            $this->cartService->addToCart($productId);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Item added to cart successfully']);
    }

    /**
     * get items in the cart of current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartItems(){
        
        $cartItems = $this->cartService->getCartItems();
        return response()->json(['cartItems' => $cartItems]);
    }

    /**
     * checkout current items
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(){
       
        $this->orderService->placeOrder();
        $this->cartService->removeCart();
        return response()->json(['success' => true]);
       
    }
}
