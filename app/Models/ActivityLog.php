<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'remark',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}
