<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('category_order', function (Builder $builder): void {
            $builder->orderBy('sort_order')->orderBy('name');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}