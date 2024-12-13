<?php

namespace App\View\Components;

use App\Services\CategoryServices\CategoryCacheService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(protected CategoryCacheService $categoryCacheService, protected $title)
    {
        // dd
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('front-end.components.front-layout',
            [
                'categories' => $this->categoryCacheService->getCategories(),
                'title' => $this->title.' | '.config('app.name'),
            ]);
    }
}
