<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
  public function payOrder($order_id){
    try{
      $order = Order::where('id', $order_id)
        ->update(['status' => 2]);

      return response()->json(['data' => 'done'], 200);
    } catch(\Exception $e){
      return response(['msg' => $e->getMessage()], 500);
    }
  }

}