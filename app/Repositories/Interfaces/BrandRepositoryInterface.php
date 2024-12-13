<?php

namespace App\Repositories\Interfaces;

use App\Models\Brand;

interface BrandRepositoryInterface
{

    public function addOrUpdatePhoto(Brand $brand, $photo);

    public function isDeleted();

    public function status(array $with = []);

}
