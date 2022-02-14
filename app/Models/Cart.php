<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cart extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'size',
        'price',
        'quantity',
        'imageSrc',
        'imageAlt'
    ];
}
