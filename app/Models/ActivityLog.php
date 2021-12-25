<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'activity'
    ];
    
    public static function LogRecord($activity)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => $activity,
        ]);
    }
}
