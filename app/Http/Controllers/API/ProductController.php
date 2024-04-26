<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\Product\AddProductRequest;
use App\Http\Requests\API\Product\UpdateProductRequest;
use App\Models\Product;
use Stripe\StripeClient;

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

    public function addProduct(AddProductRequest $request)
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        try {
            $existed = Product::where('name', $request->name)->first();

            if ($existed) {
                // Product already exists
                return response()->json(['data' =>'Product Duplicated'], 404);
            }

            $stripe_product = $stripe->products->create([
                'name' => $request->name,
                "active" => true,
                "default_price_data" => [
                    "currency" => 'myr',
                    "unit_amount_decimal" => $request->price,
                ],
            ]);

            // Product doesn't exist, create it
            Product::create([
                'name' => $request->name,
                'price' => $request->price/100,
                'status' => 0,
                'stripe_id' => $stripe_product->id,
                'category_id' => $request->category_id
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

    public function updateProduct(UpdateProductRequest $request, $id){
        try{
            Product::where('id', $id)->update($request->all());
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
