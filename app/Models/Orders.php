<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Orders extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
