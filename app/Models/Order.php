<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'status',
        'imageSrc',
        'imageAlt'
    ];
}
