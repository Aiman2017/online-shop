<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'link', 'description', 'is_featured', 'status'];

    public function photos()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1)->inRandomOrder();
    }
}
