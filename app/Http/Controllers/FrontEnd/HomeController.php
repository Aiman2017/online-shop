<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\BannerServices\BannerCacheService;
use App\Services\BrandServices\BrandCacheService;
use App\Services\CategoryServices\CategoryCacheService;

class HomeController extends Controller
{

    public function __construct(
        protected CategoryCacheService $categoryCacheService,
        protected BrandCacheService $brandCacheService,
        protected BannerCacheService $bannerCacheService,
    ) {
    }

    public function index()
    {
        return view(
            'front-end.index',
            [
                'banners' => $this->bannerCacheService->getBanners(),
                'features' => $this->bannerCacheService->getFeaturedBanners(),
                'brands' => $this->brandCacheService->getBrands(),
                'categories' => $this->categoryCacheService->getCategories(),
                'categoryProduct' => $this->categoryCacheService->getProducts(),
                'title' => "Home page | ".config('app.name'),
            ]
        );
    }


}
