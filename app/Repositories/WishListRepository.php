<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Wishlist;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class WishListRepository implements WishlistRepositoryInterface
{
    /**
     * @return mixed
     */
    public function get(): mixed
    {
        return Wishlist::query()->with('product')->where('cookie_id', $this->getCookieId())->get();
    }

    /**
     * @param  Product  $product
     * @return mixed
     */
    public function add(Product $product)
    {
        return Wishlist::query()->create([
            'cookie_id' => $this->getCookieId(),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);
    }


    /**
     * @return mixed
     */
    public function empty(): mixed
    {
        return Wishlist::query()->where('cookie_id', $this->getCookieId())->delete();
    }


    public function delete($id)
    {
        return Wishlist::query()->where('uuid', $id)->delete();
    }

    private function getCookieId(): \Ramsey\Uuid\UuidInterface|array|string|null
    {
        $cookie_id = Cookie::get('wishlist_id');

        if (empty($cookie_id)) {
            $cookie_id = Str::uuid();
            $lifetime = Carbon::now()->addWeek()->diffInMinutes(Carbon::now());
            Cookie::queue('wishlist_id', $cookie_id, $lifetime);
        }
        return $cookie_id;
    }

}
