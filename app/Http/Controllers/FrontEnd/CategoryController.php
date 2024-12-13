<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;

class CategoryController extends Controller
{
    public function index()
    {
        return view('front-end.category.index',
            [
                'title' => 'Category',
                'categories' => Category::query()->whereNull('parent_id')->get()
            ]);
    }


    public function show($slug
    ): Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $category = Category::query()
            ->with(['children'])
            ->where('slug', $slug)
            ->firstOrFail();

        $categoryIds = $this->getAllCategoryIds($category);
        $categorySlugs = $this->getAllCategorySlugs($category);
        return view('front-end.category.show', [
            'title' => $category->name,
            'category' => $category->whereIn('slug', $categorySlugs)->get(),
            'products' => Product::query()->whereIn('category_id', $categoryIds)->with(['category', 'photos'])->get(),
        ]);
    }

    /**
     * Recursively get all category IDs including children.
     */
    private function getAllCategoryIds($category): array
    {
        $ids = [$category->id];
        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }
        return $ids;
    }

    private function getAllCategorySlugs($category)
    {
        $slugs = collect($category->slug);

        foreach ($category->children as $child) {
            $slugs = $slugs->merge($child->slug);
        }

        return $slugs;
    }
}
