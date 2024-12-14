<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity', 'options'];

    public static function booted(): void
    {
        static::observe(CartObserver::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'anonymous'
        ]);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
