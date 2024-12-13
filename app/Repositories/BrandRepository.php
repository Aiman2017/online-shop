<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\traits\UploadFiles;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    use UploadFiles;

    public function __construct(public Brand $brand)
    {
        parent::__construct($brand);
    }

    public function addOrUpdatePhoto($brand, $photo): void
    {
        if ($brand->photos) {
            $this->deleteFiles($brand->photos->path);
            $brand->photos()->delete();
        }
        $brand->photos()->updateOrCreate([
            'path' => $photo
        ]);
    }

    public function status(array $with = [])
    {
        return $this->brand->with($with)->status();
    }

    public function isDeleted()
    {
    }
}
