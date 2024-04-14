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
            return response()->json(['data' => $e->getMessage()], 404);
        }
    }

    public function getProductDetail($id){
        try {
            $product = Product::find($id);
            
            return response()->json(['data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
        }
    }

    public function addProduct(Request $request)
    {
        try {
            $existed = Product::where('name', $request->name)->first();

            if ($existed) {
                // Product already exists
                return response()->json(['data' =>'Product Duplicated'], 404);
            }

            // Product doesn't exist, create it
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => 0
            ]);

            return response()->json(['data' =>'done'], 200);

        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage()], 404);
        }
    }

    public function removeProduct($id){
        try {
            Product::where('id', $id)->delete();

            return response()->json(['data' => "done"], 200);

        } catch (\Exception $e) {
            return response(['data' => $e->getMessage()], 404);
        }
    }

    public function updateProduct(Request $request, $id){
        try{
            Product::where('id', $id)->update([
                'name' => $request->name,
                'new_product' => $request->new_product,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'price' => $request->price,
            ]);
            return response()->json(['data' =>"done"], 200);
        } catch (\Exception $e) {
            return response(['data' =>$e->getMessage()], 404);
        }
    }

    public function getProductInCategory($category_id){
        try{
            $product_list = Product::where(['category_id' => $category_id, 'status' => 1])->get();
            
            return response()->json(['data' => $product_list], 200);
        } catch (\Exception $e) {
            return response(['data' =>$e->getMessage()], 404);
        }
    }
}
