<?php

namespace App\Services;

use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Cart;
use Carbon\Carbon;
use Auth;

class OrderService extends GeneralService
{
    public function index()
    {
        try {
            
            $data = [
                'DataArray' => $this->toArray(
                    Order::where('status', 'Ordered')->with('orderProduct')->get()->toArray()
                )
            ];
            
            if (!empty($data)) {
                return $this->response(
                    200,
                    'Successfully retrieved record.',
                    $data
                );
            } else {
                return $this->response(
                    404,
                    'Record not available.'
                );
            }

        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(
                404,
                'Record not available.'
            );
        }
    }

    public function toArray($results)
    {
        $data = [];
        
        foreach($results as $key => $result)
        { 
            $data[$key] = [
                'id'                    => $result['id'],
                'orderId'               => $result['reference_number'],
                'totalAmount'           => $result['total_amount'],
                'orderStatus'           => $result['status'],
                'numberOfProduct'       => count($result['order_product']),
                'product'               => $result['order_product'],
                'createdAt'             => Carbon::parse($result['created_at'])->format('d/m/Y'),
                'updatedAt'             => Carbon::parse($result['updated_at'])->format('d/m/Y'),
            ];
        }

        return $data;
    }

    public function store($elements)
    {
        try {

            $order = Order::create([
                    'user_id'               => Auth::user()->id,
                    'address_book_id'       => 1,
                    'reference_number'      => rand(10000, 19999),
                    'total_amount'          => $elements['total_amount'],
                    'status'                => 'Ordered',
                ])->toArray();

            $carts = Cart::where('user_id', Auth::user()->id)->with('product')->get();

            if(!empty($order) && !empty($carts)){

                foreach($carts as $cart){
                    $products = OrderProduct::create([
                            'order_id'      => $order['id'],
                            'product_id'    => $cart->product_id,
                            'quantity'      => $cart->quantity,
                            'price'         => $cart->product->price,
                            'total_price'   => $cart->product->price*$cart->quantity,
                    ]);

                    $cart->delete();
                }

            }

            if (!empty($products)) {
                return $this->response(
                    200,
                    'Order successfully created.'
                );
            } else {
                return $this->response(
                    404,
                    'Record not available.'
                );
            }

        } catch (\Exception $e) {
            \Log::error($e); dd($e);
            return $this->response(
                404,
                'Record not available.'
            );
        }
    }
}