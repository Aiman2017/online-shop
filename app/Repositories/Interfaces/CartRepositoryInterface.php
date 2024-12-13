<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface CartRepositoryInterface
{

    public function get();

    public function add(Product $product, int $quantity);

    public function update(Product $product, $quantity);

    public function delete(Product $product);

    public function empty();

    public function total();
}
