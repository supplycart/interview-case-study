<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(){
        return $this->belongsToMany('App\Product', 'cart')->withPivot(['id', 'quantity', 'purchased_at', 'purchased_price']);
    }

    public function role(){
      return $this->belongsTo('App\Role');
    }

    public function priceByRole($price){
      if (!is_null($this->role)) {
        switch ($this->role->name) {
          case 'member':
          $price = 0.8*$price;
          break;

          case 'staff':
          $price = 0.7*$price;
          break;
        }
      }
      return $price;
    }
}
