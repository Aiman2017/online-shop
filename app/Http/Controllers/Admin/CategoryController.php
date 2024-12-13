<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Jobs\ImportProductJob;
use App\Models\Category;
use App\Services\CategoryServices\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'admin.category.index',
            [
                'categories' => $this->categoryService->getCategories(),
                'title' => $this->categoryService->getTitle('Category List'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
//        $this->categoryService->createCategory($request->validated());
        dispatch(new ImportProductJob($request->validated()))->onQueue('categories database');

        return redirect()->route('admin.categories.index')->with(['success' => 'The category is being created!']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'admin.category.create',
            [
                'categories' => $this->categoryService->getAllCategory(),
                'title' => $this->categoryService->getTitle('Create new category'),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->categoryService->getCategory($id);

        return view('admin.category.show', [
            'title' => $this->categoryService->getTitle('Show category'),
            'category' => $data['category'],
            'subcategories' => $data['subCategory'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.category.edit', [
            'category' => $this->categoryService->getById($id),
            'categories' => $this->categoryService->getCategories(),
            'title' => $this->categoryService->getTitle('Edit Category'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $this->categoryService->updateCategory($id, $request->validated());
        return redirect()->route('admin.categories.index')->with(['success' => 'The category has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $category = $this->categoryService->deleteCategory($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->withErrors(['error' => 'The Category has not been deleted']);
        }
        return redirect()->route('admin.categories.index')->with(['success' => 'The Category has been deleted']);
    }


    public function subCategory(Request $request): JsonResponse
    {
        $categoryID = $request->id;
        $subCategories = Category::with('children')
            ->where('id', $categoryID)
            ->get();
        $subCategoryData = [];

        foreach ($subCategories as $subCategory) {
            $subCategoryData[] = $subCategory->children;
        }
        return response()->json($subCategoryData);
    }


}
