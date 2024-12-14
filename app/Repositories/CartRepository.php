<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{
    /**
     * @return mixed
     */
    public function get(): mixed
    {
        return Cart::query()->with('product')->where('cookie_id', $this->getCookieId())->get();
    }

    /**
     * @param  Product  $product
     * @return mixed
     */
    public function add(Product $product, int $quantity = 1)
    {
        return Cart::query()->create([
            'cookie_id' => $this->getCookieId(),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }


    /**
     * @param  Product  $product
     * @param $quantity
     * @return mixed
     */
    public function update(Product $product, $quantity): mixed
    {
        return Cart::query()->where('cookie_id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->update([
                'quantity' => $quantity,
            ]);
    }


    /**
     * @return mixed
     */
    public function empty(): mixed
    {
        return Cart::query()->where('cookie_id', $this->getCookieId())->delete();
    }

    /**
     * @return mixed
     */
    public function total(): mixed
    {
        return Cart::query()->where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM( products.price * carts.quantity) as total')
            ->value('total');
    }

    public function delete($id)
    {
        return Cart::query()->where('uuid', $id)->delete();
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
