<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

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

    public function scopeGetCookieId()
    {
        return Cart::query()->where('cookie_id', $this->getCookieId());
    }

    private function getCookieId(): \Ramsey\Uuid\UuidInterface|array|string|null
    {
        $cookie_id = Cookie::get('cart_id');

        if (empty($cookie_id)) {
            $cookie_id = Str::uuid();
            $lifetime = Carbon::now()->addWeek()->diffInMinutes(Carbon::now());
            Cookie::queue('cart_id', $cookie_id, $lifetime);
        }
        return $cookie_id;
    }
}
