<?php

namespace App\Models;

use App\Http\Resources\CartResource;
use App\Http\Resources\HistoryResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        "phone_num",
        "address",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function create($attributes) {
        $user = new User($attributes);
        $user->setPassword($attributes["password"]);
        $user->save();

        UserHistory::create([
            "user_id" => $user->id,
            "type" => 0
        ]);

        return $user;
    }

    public function setPassword($pw) {
        $this->password = bcrypt($pw);
    }

    public function relatedCarts() {
        return $this->hasMany(Cart::class, "user_id", "id");
    }

    public function carts() {
        return $this->relatedCarts()->where("status", 0)->get();
    }

    public function getCart() {
        return [
            "carts" => CartResource::collection($this->carts()),
            "total" => Order::calculateTotal($this->carts())
        ];
    }

    public function connectedOrders() {
        return $this->hasMany(Order::class, "user_id", "id");
    }

    public function orders() {
        $this->load("connectedOrders");
        return $this->connectedOrders;
    }

    public function histories() {
        $historyProduct = UserHistory::where("user_id", $this->id)->where("type", 3)->with("connectedProduct")->get();
        $historyOthers = UserHistory::where("user_id", $this->id)->where("type", "!=", 3)->get();
        return HistoryResource::collection($historyOthers->merge($historyProduct));
    }
}
