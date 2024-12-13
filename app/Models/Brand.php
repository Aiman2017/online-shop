<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug', 'status'];

    public static function booted()
    {
        static::creating(function ($brand) {
           $brand->slug = Str::slug($brand->name) . Str::random(6);
        });

    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function photos(): MorphOne
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    public function strReplace()
    {
        return str_replace(' ', '_', $this->name);
    }

}
