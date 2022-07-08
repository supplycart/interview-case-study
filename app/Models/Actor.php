<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class Actor extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'actors';

    protected $fillable = [
        'movie_id',
        'name',
        'sex',
        'date_of_birth',
        'biography',
        'image',
    ];

    protected $casts = [];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}