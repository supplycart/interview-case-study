<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(Request $request) {
        $viewProductsDatas = [];
        $currProductData = [
            'product_id' => 0,
            'brand_name' => '',
            'category' => '',
            'product_name' => '',
            'product_price' => 0.00
        ];

        $products = Products::all();

        for ($i = 0; $i < $products->count(); $i++) {
            $currProduct = $products[$i];

            $currProductData['product_id'] = $currProduct->id;
            $currProductData['brand_name'] = $currProduct->brand->name;
            $currProductData['category'] = $currProduct->category->name;
            $currProductData['product_name'] = $currProduct->name;
            $currProductData['product_price'] = $currProduct->price;

            array_push($viewProductsDatas, $currProductData);
        }

        return view('product_list', [
            'isCartFilled' => $this->isCartFilled($request),
            'products' => $viewProductsDatas
        ]);
    }

    public function getOrderHistory(Request $request) {
        $userID = $request->session()->get('user_id', '');

        if ($userID === '' || $userID === null) {
            abort(404);
        }

        $total = 0.00;
        $viewOrdersDatas = [];
        $currOrderData = [
            'product_id' => 0,
            'brand_name' => '',
            'category' => '',
            'product_name' => '',
            'product_price' => 0.00
        ];

        $orders = Carts::where([
            'user_id' => $userID,
            'is_in_order' => 1,
        ])->get();

        for ($i = 0; $i < $orders->count(); $i++) {
            $currOrder = $orders[$i];

            $currOrderData['product_id'] = $currOrder->product->id;
            $currOrderData['brand_name'] = $currOrder->product->brand->name;
            $currOrderData['category'] = $currOrder->product->category->name;
            $currOrderData['product_name'] = $currOrder->product->name;
            $currOrderData['product_price'] = $currOrder->product->price;

            $total += $currOrderData['product_price']; 
            array_push($viewOrdersDatas, $currOrderData);
        }

        return view('order_history', [
            'total' => $total,
            'order' => $viewOrdersDatas
        ]);
    }

    public function placeOrders(Request $request) {
        $userID = $request->session()->get('user_id', '');

        if ($userID === '' || $userID === null) {
            abort(404);
        }

        $orders = Carts::where([
            'user_id' => $userID,
            'is_in_order' => 0,
        ])->get();

        for ($i = 0; $i < $orders->count(); $i++) {
            $orders[$i]->is_in_order = 1;
            $orders[$i]->save();
        }

        return redirect()->route('product_list');
    }

    public function addToCart(Request $request) {
        $userID = $request->session()->get('user_id', '');

        if ($userID === '' || $userID === null) {
            abort(404);
        }

        if ($request->has(['product_id']) === false) {
            abort(404);
        }

        $cart = new Carts;
        $cart->product_id = $request->product_id;
        $cart->user_id = $userID;

        $cart->save();

        return response()->json(['dataType' => 'empty']);
    }

    private function isCartFilled(Request $request) {
        $userID = $request->session()->get('user_id', '');

        $cart = Carts::where([
            'user_id' => $userID,
            'is_in_order' => 1,
        ])->first();

        if ($cart === null) {
            return false;
        }

        return true;
    }
}
