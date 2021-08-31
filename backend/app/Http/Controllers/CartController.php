<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartProductResource;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Method to update existing cart or create a new cart
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string|void
     */
    public function AddToCart(Request $request){
        $user_id = auth('sanctum')->user()->UserId;

        $product_id = $request->product_id;
        $quantity = $request->quantity;

        // check if product exist and still has stock
        $exist = Product::where('ProductId', $product_id)->exists();
        $hasStock = Product::where('ProductId', $product_id)->where('Stock', '>', $quantity)->exists();
        if ($exist && $hasStock) {

            // reduce product stock
            Product::where('ProductId', $product_id)
                ->decrement('Stock', $quantity);

            // check if user has an existing cart
            if (Cart::where('UserId', $user_id)->where('ProductId', $product_id)->where('Status', '<>', 'Complete')->exists()) {

                // update the cart with quantity
                Cart::where('UserId', $user_id)
                ->where('ProductId', $product_id)
                ->where('Status', '<>', 'Complete')
                ->increment('Quantity', $quantity);

                Log::channel('syslog')->info('User '. $user_id . ' updated cart ', [
                        'cart_id' => Cart::where('UserId', $user_id)
                                    ->where('ProductId', $product_id)
                                    ->where('Status', '<>', 'Complete')
                                    ->get()
                                    ->CartId,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                ]);

                return response()->json([
                    'status' => 200,
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

                Log::channel('syslog')->info('User '. $user_id . ' created cart ', [
                    'cart_id' => $newCart->CartId,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Added to cart',
                ]);

            }

        } else if (!$hasStock){ // product out of stock
            Log::channel('errorlog')->info('User '. $user_id . ' requested for product that is out of stock ', [
                'product_id' => $product_id,
            ]);

            return response()->json([
                'status'=> 403,
                'message'=> 'Product out of stock'
            ]);

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

        // if no cart found
        if (count($carts) == 0){
            Log::channel('errorlog')->info('User '. $user_id . ' requested for cart but none found');

            return response()->json([
                'status' => 404,
                'message' => 'No cart found',
            ]);
        }

        Log::channel('syslog')->info('User '. $user_id . ' requested for incomplete carte');

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

            Log::channel('syslog')->info('User '. $user_id . ' checkout cart ', [
                'cart_id' => $cart->CartId,
            ]);

            // create new order with this cart
            // else create new cart and add item
            $newOrder = new Order;
            $newOrder->UserId = $user_id;
            $newOrder->CartId = $cartId;
            $newOrder->save();

            Log::channel('syslog')->info('User '. $user_id . ' created order '. $newOrder->OrderId . ' with cart ' . $cartId);

        }
        // success
        return response()->json([
            'status' => 200,
            'message'=> 'Order Completed'
        ]);

    }



}
