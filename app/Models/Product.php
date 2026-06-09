<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use BelongsToTenant, HasFactory, SoftDeletes;

    public const IMAGE_SOURCE_NONE = 'none';

    public const IMAGE_SOURCE_UPLOAD = 'upload';

    public const IMAGE_SOURCE_LIBRARY = 'library';

    protected $fillable = [
        'tenant_id',
        'category_id',
        'name',
        'description',
        'price_cents',
        'image_source',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope('product_order', function (Builder $builder): void {
            $builder->orderBy('sort_order')->orderBy('name');
        });
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function priceFormatted(): string
    {
        return number_format($this->price_cents / 100, 2, '.', '');
    }

    public function imageUrl(): string
    {
        return match ($this->image_source) {
            self::IMAGE_SOURCE_UPLOAD => $this->image_path
            ? Storage::disk(config('filesystems.product_disk'))->url($this->image_path)
            : asset('img/library/_placeholder.png'),
            self::IMAGE_SOURCE_LIBRARY => asset('img/library/' . basename((string) $this->image_path)),
            default => asset('img/library/_placeholder.png'),
        };
    }
}