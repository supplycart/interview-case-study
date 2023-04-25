<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addToCart(Product $product)
    {
        $cart = $this->cart()->firstOrCreate();

        // Add items to cart
        $cartItem = $cart->items()->updateOrCreate([
            'product_id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'description' => $product->description,
        ])->increment('quantity');

        // // Check if stock is available based on selected options
        // $stock = $product->checkStock($cartItem->options->pluck('id')->toArray());

        // if ($stock) {
        //     $cartItem->increment('quantity);
        // }

        activity()
            ->causedBy(auth()->user())
            ->withProperties($cartItem)
            ->log('User added a cart item.');

    }

    public function removeFromCart(Product $product)
    {
        $cart = $this->cart()->firstOrFail();

        // Remove item to cart
        $cartItem = $cart->items()->where('product_id', $product->id);

        $cartItem->delete();

        activity()
            ->causedBy(auth()->user())
            ->withProperties($cartItem)
            ->log('User removed a cart item.');

    }
}
