<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartProductResource;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Method to update existing cart or create a new cart
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string|void
     */
    public function AddToCart(Request $request){
        $user_id = auth('sanctum')->user()->UserId;

        if ($user_id === null){ // user not logged in
            return response()->json([
                'status'=> 405,
                'message'=> 'Login to continue'
            ]);

        } else {
            $product_id = $request->product_id;
            $quantity = $request->product_id;

            $productCheck = Product::whereStrict('ProductId', $product_id);
            if ($productCheck) { // product found

                // check if user has an existing cart
                if (Cart::where('UserId', $user_id)->where('ProductId', $product_id)->where('Status', '<>', 'Complete')->exists()) {

                    // update the cart with quantity
                    $cart = Cart::table('carts')
                        ->where('UserId', $user_id)
                        ->where('ProductId', $product_id)
                        ->where('Status', '<>', 'Complete')
                        ->increment('Quantity', $quantity);

                    return response()->json([
                        'status' => 201,
                        'message' => 'Added to cart',
                    ]);

                } else {
                    // else create new cart and add item
                    $newCart = new Cart;
                    $newCart->UserId = $user_id;
                    $newCart->ProductId = $product_id;
                    $newCart->Quantity = $quantity;
                    $newCart->Status = 'Progress';
                    $newCart->Cost = $request->cost;
                    $newCart->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Added to cart',
                    ]);

                }

            } else { // if product not found
                return response()->json([
                    'status'=> 409,
                    'message'=> 'Product not found'
                ]);

            }
        }

    }

    /**
     * Method to find incomplete cart of the user
     * @return \Illuminate\Http\JsonResponse
     */
    public function FindCart() {
        $user_id = auth('sanctum')->user()->UserId;

        //find cart that are still incomplete and return
        $carts = Cart::where('UserId', $user_id)
            ->where('Status', '<>', 'Completed')
            ->join('products', function ($join) {
                $join->on('carts.ProductId', '=', 'products.ProductId');
            })
            ->get();

        $cartsCollection = CartProductResource::collection($carts);

        if (count($cartsCollection) == 0){
            return response()->json([
                'status' => 200,
                'message' => 'No cart found',
            ]);
        }

        return response()->json([
            'data' => $cartsCollection,
            'status' => 200,
            'message' => 'Cart returned',
        ]);
    }

    /**
     * Method to checkout given carts by the user
     * @param Request $request List of cart id to checkout
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function checkoutCart(Request $request){
        $user_id = auth('sanctum')->user()->UserId;
        $carts = $request->carts;

        // for each cart
        foreach($carts as $cartId){
            // set status to completed
            $cart = Cart::where('CartId', $cartId)->update(['Status'=> 'Completed']);

            // create new order with this cart
            // else create new cart and add item
            $newOrder = new Order;
            $newOrder->UserId = $user_id;
            $newOrder->CartId = $cartId;
            $newOrder->save();

        }
        // success
        return response()->json([
            'status' => 200,
            'message'=> 'Order Completed'
        ]);

    }



}
