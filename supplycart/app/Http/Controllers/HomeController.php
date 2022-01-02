<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    public function search(Request $request){
        $parameters = "?";

        if (isset($request->category)) {
          $category = $request->category;
          $parameters = $parameters."&category=".$category;
        }
        if (isset($request->brand)) {
          $brand    = $request->brand;
          $parameters = $parameters."&brand=".$brand;
        }
        if (isset($request->name)) {
          $name     = $request->name;
          $parameters = $parameters."&name=".$name;
        }

        $url = url('/home').$parameters;
        return redirect($url);
    }

    public function addToCart(Request $request, $productId){
      $quantity = 1;
      if (!is_null($request->quantity) || $request->quantity>0) {
        $quantity = $request->quantity;
      }

      Auth::User()->cart()->attach($productId, ['quantity'=> $quantity]);
      // Auth::User()->cart()->attach($productId);
      // dd($request);
      // return redirect()->back();

      return redirect()->back()->withErrors([
          'message-header'  => 'Done!',
          'message-body'    => 'Added to Cart!',
        ]);
    }

    public function checkout(Request $request){
      $total = 0;
      $toPurchase = Auth::User()->cart;
      // $cartPurchaseIds = $request->items;
      foreach ($toPurchase as $key => $value) {
        // if (in_array($value->pivot->id, $cartPurchaseIds)) {
          $quantity = $value->pivot->quantity;
          $price = $value->price;
          $total = $total + ($quantity*$price);
        // }
      }

      return view('paymentpage')->with('total', $total);
    }

    public function paymentFail(){
      return redirect('/home')->withErrors([
          'message-header'  => 'Error!',
          'message-body'    => 'Paymend Failed',
        ]);
    }

    public function paymentSuccess(){
      $toPurchase = Auth::User()->cart;
      foreach ($toPurchase as $key => $value) {
        Auth::User()->cart()->updateExistingPivot($value->pivot->product_id, ['purchased_at'=> Carbon::now()]);
      }
      return redirect('/home')->withErrors([
          'message-header'  => 'Done!',
          'message-body'    => 'Payment Completed',
        ]);
    }

    public function activityLog(){
      Log::info('test');
      dd(Log::getLogger());
      foreach (Log::getLogger() as $key => $value) {
        echo $value;
      }
    }

    public function purchaseHistory(){
      return view('purchaseHistory');
    }
}
