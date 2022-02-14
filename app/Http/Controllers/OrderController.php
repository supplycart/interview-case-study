<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('order',compact('order'));
    }

    /**
     * Store new order from create page
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            foreach($request->all() as $item){
                $order = [
                    'user_id' => Auth::user()->id,
                    'name' => $item['name'],
                    'price' => 'RM'.number_format(floatval(str_replace("RM","",$item['price'])) * floatval($item['total']),2),
                    'status' => 'Delivered on '. Carbon::now()->format('d M Y'),
                    'imageSrc' => $item['imageSrc'],
                    'imageAlt' => $item['imageAlt'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $save = Order::create($order);
                if(isset($save)){
                    Cart::where('color',$item['color'])
                        ->where('size',$item['size'])
                        ->where('user_id',Auth::user()->id)
                        ->delete();
                }
            }

            return route('order');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
