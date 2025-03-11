<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ActivityLog extends Model
{
    use LogsActivity;

    protected $table = 'activity_log';

    protected $casts = [
        'created_at'  => 'date:Y-m-d H:i:s',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
