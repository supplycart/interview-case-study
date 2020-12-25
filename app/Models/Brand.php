<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'description' => '-'
    ];
    /**
     * Get the Products associated with the brand.
     */
    public function products()
    {
        return $this->hasMany(
            Product::class
        );
    }
}
