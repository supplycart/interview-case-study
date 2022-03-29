<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $with = ["connectedVoucher"];

    protected $fillable = [
        "user_id",
        "address",
        "phone_num",
        "voucher_id",
    ];

    public function connectedVoucher() {
        return $this->hasOne(Voucher::class, "id", "voucher_id");
    }

    public function voucher() {
        $this->load("connectedVoucher");
        return $this->connectedVoucher;
    }

    public static function create($attributes) {
        $order = new Order($attributes);
        $order->payment = 0; // temporary value to get order_id working first
        $order->save();

        $user = User::where("id", $attributes["user_id"])->first();

        $total = 0;

        foreach ($user->carts() as $item) {
            $cart = Cart::where("id", $item->id)->first();
            $cart->update(["status" => 1, "order_id" => $order->id]);
            $total += $cart->quantity * $cart->product->price;
            $cart->product->update(["inventory" => $cart->product->inventory - $cart->quantity]);
            $total = round($total, 2);
        }

        if ($user->role == 2) {
            // 3% discount for all members
            $total *= 0.95;
            $total = round($total, 2);
        }

        // applying voucher and discount
        if (isset($attributes["voucher_id"])) {
            $voucher = $order->voucher();
            $total -= $voucher->amount;
            $total = round($total, 2);
        }

        UserHistory::create([
            "user_id" => $user->id,
            "type" => 4,
            "related_id" => $order->id
        ]);

        $user->balance = $user->balance - $total;
        $order->payment = $total;
        $order->save();
        return $order;
    }

    public static function calculateTotal($carts, $voucher = null) {
        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
            $total = round($total, 2);
        }

        if (Auth::user()->role == 2) {
            // 3% discount for all members
            $total *= 0.95;
        }

        // applying voucher and discount
        if ($voucher != null) {
            $voucher = Voucher::where("id", $voucher)->first();
            $total -= $voucher->amount;
        }

        return $total;
    }

    public function relatedCarts() {
        return $this->hasMany(Cart::class, "order_id", "id");
    }

    public function carts() {
        $this->load("relatedCarts");
        return $this->relatedCarts;
    }

    public function connectedUser() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function user() {
        $this->load("connectedUser");
        return $this->connectedUser;
    }
}
