<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'description',
    'short_description',
    'price',
    'old_price',
    'sku',
    'status',
    'is_featured',
    'stock',
    'weight'
])]
class Product extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'old_price' => 'decimal:2',
            'weight' => 'decimal:2',
            'is_featured' => 'boolean',
            'status' => ProductStatus::class,
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getTotalStockAttribute(): int
    {
        return $this->variants()->sum('stock');
    }

    public function getMainImageAttribute()
    {
        return $this->relationLoaded('images')
            ? $this->images->firstWhere('is_main', true)
            : $this->images()->where('is_main', true)->first();
    }
}
