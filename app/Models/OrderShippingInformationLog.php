<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $order_shipping_information_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog whereOrderShippingInformationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderShippingInformationLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderShippingInformationLog extends Model
{
}
