<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $order_id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $country
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderAddress extends Model
{
}
