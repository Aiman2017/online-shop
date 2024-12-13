<?php

namespace App\Services\CategoryServices;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryCacheService
{

    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function getCategories(array $with = [])
    {
        return cache()->remember('category', now()->addDay(), function () use ($with) {
            return $this->categoryRepository->getAllWithChildrenRecursive($with);
        });
    }


    public function getProducts(): Collection
    {
        return cache()->remember('categories_with_products', now()->addDay(), function () {
            return Category::query()
                ->whereNull('parent_id')
                ->with([
                    'products' => function ($query) {
                        $query->with('photos');
                    },
                    'children.products'
                ])
                ->take(5)
                ->get();
        });
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $title = '';
        foreach ($this->getCategories() as $category) {
            $title = $category->name;
        }
        return $title;
    }

}
