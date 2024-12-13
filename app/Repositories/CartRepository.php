<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{
    /**
     * @return mixed
     */
    public function get(): mixed
    {
        return Cart::query()->getCookieId()->get();
    }

    /**
     * @param  Product  $product
     * @return mixed
     */
    public function add(Product $product, int $quantity = 1): mixed
    {
        return Cart::query()->create([
            'cookie_id' => Str::uuid(),
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
        return Cart::query()->getCookieId()
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
        return Cart::query()->getCookieId()->delete();
    }

    /**
     * @return mixed
     */
    public function total(): mixed
    {
        return Cart::query()->getCookieId()
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('SUM(carts.quantity * carts.product_price) as total')
            ->value('total');
    }

    /**
     * @param  Product  $product
     * @return mixed
     */
    public function delete(Product $product): mixed
    {
        return Cart::query()->getCookieId()->where('product_id', $product->id)->delete();
    }
}
