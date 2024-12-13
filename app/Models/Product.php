<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'slug',
        'category_id',
        'brand_id',
        'status',
        'additional_info',
    ];

    protected $perPage = 5;


    public static function booted(): void
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name).'-'.Str::random(2);
            $product->code = str_replace('-', '', Str::uuid()->toString());
        });
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable')->orderBy('position', 'asc');
    }

    public function scopeFilter(Builder $builder, array $filter): void
    {
        $filter = array_merge([
            'categories' => null,
            'sizes' => null,
            'colors' => null,
            'brands' => null,
            'min_price' => null,
            'max_price' => null,
            'search' => null,
        ], $filter);

        $builder->when($filter['categories'], function (Builder $query) use ($filter) {
            $query->whereHas('category', function (Builder $query) use ($filter) {
                $categories = Category::query()
                    ->whereIn('name', $filter['categories'])
                    ->with('children')
                    ->get();
                $categoryIds = $categories->pluck('id')->toArray();
                $childCategoryIds = $categories->pluck('children.*.name')->flatten()->toArray();

                $allCategoryIds = array_merge($categoryIds, $childCategoryIds);
                $query->whereIn('categories.id', $allCategoryIds);
            });
        });

        $builder->when($filter['sizes'], function (Builder $query) use ($filter) {
            $query->whereHas('variants.size', function (Builder $query) use ($filter) {
                $query->whereIn('sizes.name', $filter['sizes']);
            });
        });

        $builder->when($filter['colors'], function (Builder $query) use ($filter) {
            $query->whereHas('variants.color', function (Builder $query) use ($filter) {
                $query->whereIn('colors.name', $filter['colors']);
            });
        });

        $builder->when($filter['brands'], function (Builder $query) use ($filter) {
            $query->whereHas('brand', function (Builder $query) use ($filter) {
                $query->whereIn('brands.name', $filter['brands']);
            });
        });

        $builder->when($filter['min_price'], function (Builder $builder, $value) {
            $builder->where('price', '>=', $value);
        });

        $builder->when($filter['max_price'], function (Builder $builder, $value) {
            $builder->where('price', '<=', $value);
        });

        $builder->when($filter['search'], function (Builder $builder, $value) {
            $builder->where(function ($query) use ($value) {
                $query->where('name', 'like', '%'.$value.'%')
                    ->orWhere('description', 'like', '%'.$value.'%');
            })->orWhereHas('category', function ($query) use ($value) {
                $query->where('name', 'like', '%'.$value.'%');
            });
        });
    }
}
