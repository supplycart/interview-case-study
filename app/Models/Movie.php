<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

class Movie extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'movies';

    protected $fillable = [
        'name',
        'year_of_release',
        'plot',
        'image',
    ];

    protected $casts = [];

    public function actors(): HasMany
    {
        return $this->hasMany(Actor::class)->orderBy('id');
    }

    public function producer(): HasOne
    {
        return $this->hasOne(Producer::class)->orderBy('id');
    }
}