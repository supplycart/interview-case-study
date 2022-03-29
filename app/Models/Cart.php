<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $with = ["product"];

    protected $fillable = [
        "user_id",
        "product_id",
        "quantity",
        "order_id",
        "status"
    ];

    public static function create($attributes) {
        $existing = Cart::where("user_id", $attributes["user_id"])->where("product_id", $attributes["product_id"])->where("status", 0)->first();
        if ($existing != null) {
            return false;
        }
        $cart = new Cart($attributes);
        $cart->save();

        UserHistory::create([
            "user_id" => $attributes["user_id"],
            "type" => 3,
            "related_id" => $attributes["product_id"]
        ]);

        return $cart;
    }

    public function relatedUser() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function user() {
        $this->load("relatedUser");
        return $this->relatedUser;
    }

    public function product() {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function relatedOrder() {
        return $this->belongsTo(Order::class, "order_id", "id");
    }

    public function order() {
        $this->load("relatedOrder");
        return $this->relatedOrder;
    }
}
