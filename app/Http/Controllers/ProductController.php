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

class ProductController extends Controller
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
        $products = Product::with(['categories', 'brands', 'price'])->get();
        foreach($products as $product){
          $product->priceAmount();
        }
        return response()->json( $products );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = DB::table('status')->select('status.name as label', 'status.id as value')->get();
        return response()->json( $statuses );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required|max:1024',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required|max:64'
        ]);
        $user = auth()->userOrFail();
        $note = new Notes();
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->users_id = $user->id;
        $note->save();
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = DB::table('notes')
        ->join('users', 'users.id', '=', 'notes.users_id')
        ->join('status', 'status.id', '=', 'notes.status_id')
        ->select('notes.*', 'users.name as author', 'status.name as status', 'status.class as status_class')
        ->where('notes.id', '=', $id)
        ->first();
        return response()->json( $note );
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
    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required|max:1024',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required|max:64'
        ]);
        $note = Notes::find($id);
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->save();
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
        'product_id' => $productId
      ]);
      $cartProduct->update([
        'amount' => $cartProduct->amount + 1
      ]);

      return response()->json( ['status' => 'success'] );
    }
}
