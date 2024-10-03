<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $order_id
 * @property string $courier
 * @property string $shipping_id
 * @property string $shipping_fee
 * @property int $status_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereCourier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereShippingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderShippingInformation extends Model
{
}
