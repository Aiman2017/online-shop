<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $filters = request()->only(['categories', 'sizes', 'search', 'colors', 'brands', 'min_price', 'max_price']);

        return view('front-end.products.index', [
            'title' => 'Products',
            'products' => Product::query()
                ->with(['photos', 'category'])
                ->filter($filters)
                ->paginate(),

            'brands' => Brand::query()->get(),
            'sizes' => Size::query()->get(),
            'colors' => Color::query()->get(),

            'categories' => Category::query()
                ->whereNull('parent_id')
                ->with('children')
                ->withCount('products')
                ->get(),
            'data' => $filters,
        ]);
    }
}
