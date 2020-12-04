<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cart;

class Users extends Model
{
    use SoftDeletes;

    /**
     * Get the notes for the users.
     */
    public function notes()
    {
        return $this->hasMany('App\Notes');
    }

    /**
     * Get the cart for user
     */
    public function cart()
    {
      return $this->hasOne('App\Models\Cart');
    }

    protected $dates = [
        'deleted_at'
    ];
}