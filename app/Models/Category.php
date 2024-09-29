<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Good;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'parent_id', 'is_active', 'is_navigational', 'manual_url'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_navigational' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(fn (Category $category) => ($category->slug = $category->slug ?? str($category->title)->slug()));
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }

    public function loopCategories($categories)
    {
        foreach ($categories as $category) {
            if ($category->subcategories()->count()) {
                $category['subcategories'] = $category->subcategories;
                $this->loopCategories($category->subcategories);
            }
        }

        return $categories;
    }
}
