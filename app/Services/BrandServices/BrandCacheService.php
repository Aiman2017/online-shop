<?php

namespace App\Services\BrandServices;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class BrandCacheService
{


    public function __construct(protected BrandRepositoryInterface $brandRepository)
    {
    }

    public function getBrands()
    {
        return Cache::remember('brands', now()->addDay(), function () {
            return $this->brandRepository->status(['photos'])->get();
        });
    }
}
