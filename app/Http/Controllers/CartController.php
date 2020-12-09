<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartProduct;

class CartController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      if(count(Auth::user()->cart) > 0){
        $items = Auth::user()->cart->first()->products;
        foreach($items as $item){
          $item->price;
        }
        return response()->json( $items );
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = DB::table('notes')->where('id', '=', $id)->first();
        $statuses = DB::table('status')->select('status.name as label', 'status.id as value')->get();
        return response()->json( [ 'statuses' => $statuses, 'note' => $note ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request, $id)
    {
      $cp = CartProduct::findOrFail($id);
      $cp->amount = $cp->amount + 1;
      $cp->save();

      return response()->json( ['status' => 'success'] );
    }    
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function removeItem(Request $request, $id)
   {
     $cp = CartProduct::findOrFail($id);
     $cp->amount = $cp->amount - 1;
     $cp->save();

     if($cp->amount == 0){
       $cp->delete();
     }

     return response()->json( ['status' => 'success'] );
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Notes::find($id);
        if($note){
            $note->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

    public function addToCart($productId)
    {
      $user = Auth::user();
      $cart = Cart::firstOrCreate([
        'user_id' => $user->id
      ]);
      $cartProduct = CartProduct::firstOrCreate([
        'cart_id' => $cart->id,
        'product_id' => $productId,
      ], [
        'amount' => 0
      ]);
      $cartProduct->update([
        'amount' => $cartProduct->amount + 1
      ]);
    }
}
