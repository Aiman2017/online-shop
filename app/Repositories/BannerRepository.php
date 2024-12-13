<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    public function __construct(public Banner $banner)
    {
        parent::__construct($banner);
    }

    public function status(array $with = [])
    {
        return $this->banner->with($with)->status();
    }

}
