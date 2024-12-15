<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface WishlistRepositoryInterface
{

    public function get();

    public function add(Product $product);

    public function delete(int $id);

    public function empty();

}
