<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Cart;
use Carbon\Carbon;
use Auth;

class ProductService extends GeneralService
{

	public function list($elements)
    {
        try {

            if($elements['category'] != 'null' || $elements['brand'] != 'null'){
                $product = Product::where('is_delete', false)
                    ->where('is_active', true)
                    ->where('category_id', $elements['category'])
                    ->with('brand')
                    ->with('category')
                    ->get()
                    ->toArray();
            }else{ 
                $product = Product::where('is_delete', false)->where('is_active', true)->with('brand')->with('category')->get()->toArray();
            }
            
            $data = [
                    'count' => Product::where('is_delete', false)->where('is_active', true)->count(),
                    'DataArray' => $this->toArray(
                        $product
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
                'id'            => $result['id'],
                'name'          => $result['name'],
                'brand'         => $result['brand']['name'],
                'category'      => $result['category']['name'],
                'price'         => $result['price'],
                'createdAt'     => Carbon::parse($result['created_at'])->format('d/m/Y'),
                'updatedAt'     => Carbon::parse($result['updated_at'])->format('d/m/Y'),
            ];
        }

        return $data;
    }

    public function show($id)
    {
        try {

            $results = Product::where('id', $id)->with('category')->with('brand')->where('is_active', true)->where('is_delete', false)->first();

            $data = [
                    'DataArray' => $this->toArrayIndividual($results->toArray())
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

    public function toArrayIndividual($result)
    {
        $data = [];
        
        $data = [
            'id'                    => $result['id'],
            'name'                  => $result['name'],
            'sku'                   => $result['sku'],
            'description'           => $result['description'],
            'price'                 => $result['price'],
            'quantity'              => $result['quantity'],
            'category'              => $result['category']['name'],
            'brand'                 => $result['brand']['name'],
            'createdAt'             => Carbon::parse($result['created_at'])->format('d/m/Y'),
            'updatedAt'             => Carbon::parse($result['updated_at'])->format('d/m/Y'),
        ];
        
        return $data;
    }

    public function addToCart($elements)
    {
        $results = Cart::where('user_id', Auth::user()->id)->where('product_id', $elements['id'])->first();

        if(!empty($results)){
            $results->quantity = $results->quantity + $elements['quantity'];
            $results->save();
        }else{
            $results = Cart::create([
                'user_id'       => Auth::user()->id,
                'product_id'    => $elements['id'],
                'quantity'      => $elements['quantity']
            ]);
        }

        if (!empty($results)) {
            return $this->response(
                200,
                'Cart successfully updated.'
            );
        } else {
            return $this->response(
                404,
                'Record not available.'
            );
        }
    }

    public function brand()
    {
        try {
            
            $data = [
                    'DataArray' => Brand::where('is_delete', false)->where('is_active', true)->select('id', 'name')->get()->toArray()
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
            \Log::error($e); dd($e, 'here');
            return $this->response(
                404,
                'Record not available.'
            );
        }
    }

    public function category()
    {
        try {
            
            $data = [
                    'DataArray' => Category::where('is_delete', false)->where('is_active', true)->select('id', 'name')->get()->toArray()
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
}