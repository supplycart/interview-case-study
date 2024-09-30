<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $value
 * @property string|null $description
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup query()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterLookup whereValue($value)
 * @mixin \Eloquent
 */
class MasterLookup extends Model
{
}
