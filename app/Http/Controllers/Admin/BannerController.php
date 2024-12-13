<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Services\BannerServices\BannerService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class BannerController extends Controller
{
    public function __construct(protected BannerService $bannerService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'admin.banners.index',
            [
                'banners' => $this->bannerService->getBanners(),
                'title' => $this->bannerService->getTitle('Banner List')
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->bannerService->createBanner($validated, $request);
        return redirect()->route('admin.banners.index')->with(
            'success',
            $this->bannerService->getTitle('Banner has been created')
        );
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.banners.create', [
            'title' => $this->bannerService->getTitle('Create Banner'),
        ]);
    }

    /**
     * @param  string  $id
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.banners.show', [
            'banner' => $this->bannerService->getBanner($id),
            'title' => $this->bannerService->getTitle('Show Banner')
        ]);
    }

    /**
     * @param  string  $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        return $this->bannerService->deleteBanner($id);
    }
}
