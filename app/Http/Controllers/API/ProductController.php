<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductList(Request $request)
    {
        try {
            $product_list = Product::all();
            
            return response()->json(['data' => $product_list], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getProductDetail($id){
        try {
            $product = Product::find($id);
            
            return response()->json(['data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function addProduct(Request $request)
    {
        try {
            $existed = Product::where('name', $request->name)->first();

            if ($existed) {
                // Product already exists
                return response()->json(['msg' => 'Product Duplicated'], 400);
            }

            // Product doesn't exist, create it
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => 0
            ]);

            return response()->json(['msg' => 'Product Added'], 200);

        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function removeProduct(Request $request){
        try {
            Product::where('id', $request->id)->delete();

            return response()->json(['msg' => "Product Deleted"], 200);

        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request){
        try{
            $product = Product::find($request->id);

            Product::where('id', $request->id)->update(['status' => !$product->status]);

            return response()->json(['msg' => "Product Status Updated"], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 500);
        }
    }
}
