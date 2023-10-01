<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'total_price' => 'decimal:2'
    ];

    public function getSnapshotAttribute($value) {
        return json_decode($value);
    }
}
