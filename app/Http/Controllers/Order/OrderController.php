<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\BaseController;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

use App\Jobs\OrderDetails;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
        // get user who is currently logged in and made the order
        $user = Auth::user();

        //create order first (store in db)
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_date = Carbon::now()->toDateTimeString();
        $order->order_status = 'completed';
        $saved = $order->save();

        if($saved)
        {
            //create order detail in Jobs
            $this->dispatch(new OrderDetails($request->data, $user->id, $order->id));

            return $this->sendResponse($order->id, 'Successfully placed an order!');
        }
        else
        {
            return $this->sendError('', 'Failed to place an order!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderHistory()
    {
        // get user who is currently logged in and made the order
        $user = Auth::user();
        $purchased = Order::with('OrderDetail')->where('user_id', $user->id)->get();

        $data = array();

        foreach($purchased as $key => $p)
        {
            $items = array();
            $detail = $p->OrderDetail;
            if(!empty($detail))
            {
                $total_price = 0;
                foreach($detail as $d)
                {
                    array_push($items, array(
                        'item_id' => $d->item_id,
                        'item_name' =>$d->item_name,
                        'item_quantity' =>$d->item_quantity,
                        'item_price' => $d->price_per_item,
                        'total_price' => $d->total_price,
                        'created_at' => $d->created_at,
                    ));

                    $total_price += $d->total_price;
                }
            }

            array_push($data, array(
                'order_id' => $p->id,
                'user_id' => $p->user_id,
                'total_order' => $total_price,
                'created_at' => $p->created_at->toDateTimeString(),
                'status' => $p->order_status,
            ));

        }



        return \DataTables::of($data)->addIndexColumn()
        ->addColumn('total_order', function($row) {
            $data = '$'.$row['total_order'];
            return $data;
        })->rawColumns(['total_order'])->make(true);

    }

    /**
     * Display after order page (success)
     *
     * @param  \App\Models\Order\OrderController  $orderController
     * @return \Illuminate\Http\Response
     */
    public function successOrder($id)
    {
        if($id != 'null')
        {
            $success = true;
            return view('order.after-order', compact('success', 'id'));
        }
        else
        {
            $success = false;
            return view('order.after-order', compact('success', 'id'));
        }

    }

    /**
     * Display after order page (fail)
     *
     * @param  \App\Models\Order\OrderController  $orderController
     * @return \Illuminate\Http\Response
     */
    public function failOrders()
    {
        return view('order.after-order', compact('fail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order\OrderController  $orderController
     * @return \Illuminate\Http\Response
     */
    public function viewHistory()
    {
        return view('order.order-history');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order\OrderController  $orderController
     * @return \Illuminate\Http\Response
     */
    public function orderDetails(Request $request)
    {
        $order = OrderDetail::where('order_id', $request->id)->get();

        if(!empty($order))
        {
            $order_arr = array();

            foreach($order as $o)
            {
                $product = Product::where('product_id', $o->item_id)->first();

                array_push($order_arr, array(
                    'order_id' => $o->order_id,
                    'item_id' => $o->item_id,
                    'item_name' => $o->item_name,
                    'item_quantity' => $o->item_quantity,
                    'item_price' => $o->price_per_item,
                    'total_price' => $o->total_price,
                    'item_picture' => $product->product_image,
                ));
            }

            return $this->sendResponse('Successfully Get The Order details', $order_arr);
        }
        else
        {
            return $this->sendResponse('Could not catch any details', '');
        }

    }
}
