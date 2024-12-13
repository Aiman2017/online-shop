<?php

namespace App\Services\BannerServices;

use App\Repositories\BannerRepository;
use Illuminate\Support\Facades\Cache;

class BannerCacheService
{

    public function __construct(protected BannerRepository $bannerRepository)
    {
    }

    /**
     * Получение всех баннеров с кешированием
     */
    public function getBanners()
    {
        return Cache::remember('banners', now()->addMinutes(30), function () {
            return $this->bannerRepository->status(['photos'])->get();
        });
    }

    /**
     * Получение избранных баннеров с кешированием
     */
    public function getFeaturedBanners()
    {
        return Cache::remember('features', now()->addMinutes(30), function () {
            return $this->getBanners()->where('is_featured', true)->take(2);
        });
    }
}
