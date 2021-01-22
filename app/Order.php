<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @method static insertGetId(array $array)
 * @method static create(array $array)
 */
class Order extends Model
{

    protected $fillable = [
        'user_id',
        'total'
    ];

    public static function create_order($data)
    {
        DB::beginTransaction();

        $order = Order::InsertIntoOrder($data);
        if (!$order->id) {
            throw new Exception("Failed to save new order");
        }

        Order::InsertIntoOrderItems($order->id);

        DB::commit();
    }

    private static function InsertIntoOrder($request)
    {
        return Order::create([
            'user_id' => Auth::user()->id,
            'total' => $request->total,
        ]);
    }

    private static function InsertIntoOrderItems($order_id)
    {
        foreach(session('cart') as $id => $details){
            OrderItems::create([
                'order_id' => $order_id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
            ]);

            $cart = session()->get('cart');

            if(isset($cart[$id])) {

                unset($cart[$id]);

                session()->put('cart', $cart);
            }
        }
    }

    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
