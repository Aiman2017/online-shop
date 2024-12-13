<?php

namespace App\Repositories\Interfaces;

use App\Models\Banner;

interface BannerRepositoryInterface
{
    public function addManyPhoto(Banner $banner, array $photos);
    public function status(array $with);
}
