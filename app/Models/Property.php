<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Good;
use App\Models\Category;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'filterable', 'name', 'slug'];

    protected $casts = [
        'filterable' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class)->withPivot('value');
    }
}
