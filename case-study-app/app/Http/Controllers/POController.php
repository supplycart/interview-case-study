<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PurchaseOrder;
use App\Models\Product;

class POController extends Controller
{
    function viewPO()
    {
        $carts = Cart::where('id_user', Auth::user()->id)
                     ->pluck('id');
        $purchaseOrder = PurchaseOrder::whereIn('id_cart', $carts)
                                      ->get();

        return view('po.viewPO', compact('purchaseOrder'));
    }

    function viewPOItems($id)
    {
        $purchaseOrder = PurchaseOrder::where('id', $id)
                                      ->first();

        $cartItems = CartItem::where('id_cart', $purchaseOrder->id_cart)
                             ->get();

        $product = Product::whereIn('id', $cartItems->pluck('id_product'))
                           ->get()
                           ->keyBy('id');

        return view('po.viewPOItems', compact('cartItems', 'product', 'purchaseOrder'));
    }

    function updateOrder(Request $request)
    {
        $po = PurchaseOrder::where('id', $request->po)->first();

        if($request->action == "completePO")
        {
            $po->status = 2;
            $po->save();
        }
        elseif($request->action == "cancelPO")
        {
            $po->status = 3;
            $po->save();
        }
        return redirect(route("viewPO"))
                ->with("success", "Purchase Order Updated!");
    }
}
