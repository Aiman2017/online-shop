<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

// В модели Category
    protected $fillable = ['name', 'description', 'parent_id', 'slug'];

    protected static function booted(): void
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name).'-'.Str::random(2);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name).'-'.Str::random(2);
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault(['name' => '']);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function allChildren(): array
    {
        $allChildren = [];

        $addChildren = function ($category, $level = 1) use (&$allChildren, &$addChildren) {
            foreach ($category->children as $child) {
                $child->level = $level;
                $allChildren[] = $child;
                $addChildren($child, $level + 1);
            }
        };

        $addChildren($this);

        return $allChildren;
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute($value): string
    {
        return ucfirst($value);
    }


}
