<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Cart;
use Carbon\Carbon;
use Auth;
use DB;

class CartService extends GeneralService
{

	public function list()
    {
        try {
            
            $results = Cart::where('user_id', Auth::user()->id)->get();

            $data = [
                    'count' => $results->count(),
                    'DataArray' => $this->toArray(Cart::where('user_id', Auth::user()->id)->with('product')->get()->toArray())
                ];
            
            if (!empty($results)) {
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
            $brand = Brand::where('id', $result['product_id'])->first()->toArray();

            $data[$key] = [
                'id'            => $result['id'],
                'userId'        => $result['user_id'],
                'quantity'      => $result['quantity'],
                'product'       => $result['product'],
                'brand'         => $brand,
                'createdAt'     => Carbon::parse($result['created_at'])->format('d/m/Y'),
                'updatedAt'     => Carbon::parse($result['updated_at'])->format('d/m/Y'),
            ];
        }

        return $data;
    }

    public function remove($id)
    {
        $results = Cart::find($id);
        $results->delete();

        if (!empty($results)) {
            return $this->response(
                200,
                'Cart successfully remove.'
            );
        } else {
            return $this->response(
                404,
                'Record not available.'
            );
        }
    }
}