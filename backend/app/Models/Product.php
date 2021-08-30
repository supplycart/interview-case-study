<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Product
 *
 * @mixin Builder
 * @property int $ProductId
 * @property string $Name
 * @property string $Detail
 * @property int $Stock
 * @property float $Price
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereDetail($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereProductId($value)
 * @method static Builder|Product whereStock($value)
 */
class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Name',
        'Detail',
        'Stock',
        'Price',
    ];
}
