<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Color;
use App\Models\Size;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\traits\UploadFiles;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use UploadFiles;

    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected BrandRepositoryInterface $brandRepository,
        protected CategoryRepositoryInterface $categoryRepository,
    ) {
    }


    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $cacheKey = 'products_paginated_';

        $product = Cache::rememberForever($cacheKey, function () {
            return $this->productRepository->getPaginateWithRelations(['category']);
        });
        return view('admin.products.index', [
            'products' => $product,
            'title' => $this->productRepository->title('Products'),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $colors = [
            'colors' => $request->input('color_name'),
            'price' => $request->input('color_price'),
        ];

        $sizes = [
            'sizes' => $request->input('size_name'),
            'price' => $request->input('size_price'),
        ];

        try {
            $product = $this->productRepository->create($request->validated());
            $files = $this->uploadFiles($request, 'images', 'products/'.$product->name);

            if ($files) {
                $this->productRepository->addManyPhoto($product, $files);
            }

            $sizeCreated = $this->createVariants($sizes, 'size', Size::class);
            $colorCreated = $this->createVariants($colors, 'color', Color::class);

            foreach ($sizeCreated as $size) {
                foreach ($colorCreated as $color) {
                    $this->productRepository->variants($product, [
                        'size_id' => $size->id,
                        'color_id' => $color->id,
                        'stock' => $request->input('stock'),
                    ]);
                }
            }
            Cache::forget('products_paginated_');

            return redirect()->route('admin.products.index')->with('status', 'Product created successfully!');
        } catch (Exception $e) {
            Log::error("Product creation failed: ".$e->getMessage());
            return redirect()->back()->withErrors('There was an error creating the product. Please try again Later.');
        }
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'admin.products.create',
            [
                'title' => $this->productRepository->title('Create Product'),
                'brands' => $this->brandRepository->getAllWithWhere(['status' => true]),
                'categories' => $this->categoryRepository->getAllWithRelations(['children'])->whereNull('parent_id'),
            ]
        );
    }

    private function createVariants(array $elements, string $name, Model|string $modelClass): array
    {
        $variants = [];
        foreach ($elements[$name.'s'] as $index => $element) {
            $price = $elements['price'][$index] ?? 0;

            $variants[] = $modelClass::query()->create([
                'name' => $element,
                'price' => $price,
            ]);
        }
        return $variants;
    }

    public function show(int $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.products.show', [
            'title' => $this->productRepository->title('Show Product'),
            'product' => $this->productRepository->find(
                $id,
                ['variants.color', 'variants.size', 'brand', 'category', 'photos']
            )
        ]);
    }

    public function edit()
    {
        return view('admin.products.edit', [
            'title' => $this->productRepository->title('Edit Product'),
        ]);
    }

    public function destroy(int $id)
    {
        $product = $this->productRepository->find($id);
        try {
            $this->productRepository->deleteManyPhotos($product, 'photos');
            $product->delete();
            Cache::forget('cacheKey');
            return redirect()->route('admin.products.index')->with('status', 'Product deleted!');
        } catch (Exception $e) {
            Log::error("Product creation failed: ".$e->getMessage());

            return redirect()->back()->withErrors('There was an error deleting the product. Please try again Later.');
        }
    }


    public function update()
    {
    }
}
