<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_in_cents',
        'stock_quantity',
        'category_id',
        'brand_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_in_cents' => 'integer',
        'stock_quantity' => 'integer',
    ];

    /**
     * Get the route key for the model.
     * Allows using 'slug' in route model binding instead of 'id'.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the order items associated with the product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the attribute values for the product. (Bonus)
     * The 'product_attribute_values' is the name of the pivot table.
     */
    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
        // ->withTimestamps(); // if pivot table had timestamps
    }

    /**
     * Get user-specific prices for this product. (Bonus)
     */
    public function userSpecificPrices(): HasMany
    {
        return $this->hasMany(UserProductPrice::class);
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that the product belongs to.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Helper method to decrement stock quantity safely.
     * (Could also be an observer or service layer logic)
     *
     * @param int $quantity
     * @return bool
     */
    public function decrementStock(int $quantity): bool
    {
        if ($this->stock_quantity >= $quantity) {
            $this->stock_quantity -= $quantity;
            return $this->save();
        }
        return false;
    }

    /**
     * Helper method to increment stock quantity.
     *
     * @param int $quantity
     * @return bool
     */
    public function incrementStock(int $quantity): bool
    {
        $this->stock_quantity += $quantity;
        return $this->save();
    }
}
