<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'imageSrc',
        'imageAlt',
        'price',
        'rating',
        'reviewCount',
        'colors',
        'sizes'
    ];
}
