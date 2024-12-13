<?php

namespace App\Services\CategoryServices;

use App\Events\CacheEvents;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CategoryService
{

    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function getCategories()
    {
        $currentPage = request()->get('page', 1);

        $cacheKey = 'categories_page_'.$currentPage;

        return cache()->remember($cacheKey, now()->addDay(), function () {
            return $this->categoryRepository->getPaginateWithRelations(['parent'],
                page: 5);
        });
    }


    public function getCategory($id): array
    {
        $category = $this->getById($id);
        $subcategory = $category->allChildren();

        return [
            'category' => $category,
            'subCategory' => $subcategory
        ];
    }

    public function getAllCategory(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory($request)
    {
        try {
            $category = $this->categoryRepository->create($request);
        } catch (QueryException $e) {
            Log::error('Error saving category: '.$e->getMessage());
            return back()->withErrors(['msg' => 'Ошибка сохранения категории']);
        }
        $this->clearCachePages();
        event(new CacheEvents('category', $category->id));

        return $category;
    }

    public function getById(int $id): Model
    {
        return $this->categoryRepository->find($id);
    }

    public function updateCategory($id, $request): Model
    {
        $category = $this->categoryRepository->update($id, $request);
        event(new CacheEvents('category', $id));
        $this->clearCachePages();

        return $category;
    }

    public function deleteCategory($id): bool
    {
        try {
            $this->categoryRepository->delete($id);
            event(new CacheEvents('category', $id));
            $this->clearCachePages();
        } catch (QueryException $e) {
            Log::error('Error deleting category: '.$e->getMessage());
        }
        return true;
    }

    public function getTitle(string $title): string
    {
        return $this->categoryRepository->title($title);
    }

    public function clearCachePages(): void
    {
        $page = 1;
        while (cache()->has('categories_page_'.$page)) {
            event(new CacheEvents('categories_page_'.$page));
            $page++;
        }
    }
}
