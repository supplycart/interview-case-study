<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model // Note: Model singular, table plural
{
    use HasFactory;

    protected $table = 'user_activity_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'ip_address',
        'user_agent',
        'logged_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'array', // Cast JSONB to array
        'logged_at' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     * Set to false because we have a custom 'logged_at' field.
     *
     * @var bool
     */
    public $timestamps = false; // No created_at/updated_at needed, we use logged_at

    /**
     * Get the user who performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
