<?php

namespace App\Services\BannerServices;

use App\Events\CacheEvents;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\traits\UploadFiles;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class BannerService
{
    use UploadFiles;

    public function __construct(protected BannerRepositoryInterface $bannerRepository)
    {
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getBanners(): LengthAwarePaginator
    {
        return $this->bannerRepository->getPaginateWithRelations();
    }

    /**
     * @param $id
     * @return Model
     */
    public function getBanner($id): Model
    {
        return $this->bannerRepository->find($id, ['photos']);
    }

    /**
     * @param  string  $title
     * @return string
     */
    public function getTitle(string $title): string
    {
        return $this->bannerRepository->title($title);
    }

    /**
     * @param $validated
     * @param $request
     * @return mixed
     */
    public function createBanner($validated, $request): mixed
    {
        $banner = $this->bannerRepository->create($validated);
        $files = $this->uploadFiles($request, 'photo', 'banners/'.$banner->title);
        if ($files) {
            $banner = $this->bannerRepository->addOnePhoto($banner, $files[0]);
        }
        event(new CacheEvents('banners', $banner->id));

        return $banner;
    }

    /**
     * @param  int  $id
     * @return RedirectResponse
     */
    public function deleteBanner(int $id): RedirectResponse
    {
        try {
            $banner = $this->bannerRepository->find($id);
            $path = $banner->photos->path;
            $this->deleteFiles($path);
            $banner->photos()->delete();
            $banner->delete();

            event(new CacheEvents('banners', $id));
            return redirect()->route('admin.banners.index')->with(
                'success',
                $this->bannerRepository->title('Banner has been deleted')
            );
        } catch (\Exception $e) {
            Log::error(' Line: '.$e->getLine().' File: '.$e->getFile());
            return redirect()->back()->withErrors(['errors' => 'There was an error while deleting the banner']);
        }
    }
}
