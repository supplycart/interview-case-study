<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class);
    }

}
