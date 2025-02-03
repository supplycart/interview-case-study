<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array', // convert JSON to PHP assoc array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
