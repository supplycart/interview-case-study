<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttributeValue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'attribute_id',
        'value',
    ];

    /**
     * Get the attribute that this value belongs to.
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Get the products associated with this attribute value.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values');
            // ->withTimestamps(); // if pivot table had timestamps
    }
}
