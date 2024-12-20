<?php

namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class  ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(public Product $product)
    {
        parent::__construct($product);

        $this->product = $product;
    }

    public function variants(Product $product, $data)
    {
        return $product->variants()->create($data);
    }

}
