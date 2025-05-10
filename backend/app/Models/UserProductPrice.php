<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot; // Can extend Pivot if you want custom pivot model behavior

// If this model is primarily a pivot with extra attributes, extending Pivot can be useful.
// Otherwise, extending Model is fine.
class UserProductPrice extends Model // Or extends Pivot
{
    use HasFactory;

    protected $table = 'user_product_prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'price_in_cents',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_in_cents' => 'integer',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     * Set to false because we use a composite primary key.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key for the model.
     * Define the composite primary key.
     *
     * @var array
     */
    protected $primaryKey = ['user_id', 'product_id'];


    /**
     * Get the user for this specific price.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product for this specific price.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
