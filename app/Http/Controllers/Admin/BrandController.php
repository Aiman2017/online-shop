<?php

namespace App\Http\Controllers\Admin;

use App\Events\CacheEvents;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\traits\UploadFiles;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    use uploadFiles;

    public function __construct(protected BrandRepositoryInterface $brandRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'admin.brands.index',
            [
                'title' => $this->brandRepository->title(title: 'Brands'),
                'brands' => $this->brandRepository->getPaginateWithRelations(['photos'], page: 4),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand = $this->brandRepository->create($request->validated());
        $files = $this->uploadFiles($request, 'photo', $brand->strReplace());

        if (!empty($files)) {
            $this->brandRepository->addOrUpdatePhoto($brand, $files[0]);
        }
        event(new CacheEvents('brands', $brand->id));

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.brands.create',
            [
                'title' => $this->brandRepository->title(title: 'Create Brand'),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'admin.brands.edit',
            [
                'title' => $this->brandRepository->title('Edit Brand'),
                'brand' => $this->brandRepository->find($id, ['photos']),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $brand = $this->brandRepository->update($id, $request->validated());
        $files = $this->uploadFiles($request, 'photo', 'Brand/'.$brand->strReplace());

        if (!empty($files)) {
            $this->brandRepository->addOrUpdatePhoto($brand, $files[0]);
        }

        event(new CacheEvents('brands', $brand->id));

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $brand = $this->brandRepository->find($id);
        if ($brand->photos) {
            $this->deleteFiles($brand->photos->path);
            $brand->photos()->delete();
        }
        $brand->delete();
        event(new CacheEvents('brands', $id));

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }

}
