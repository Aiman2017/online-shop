<?php

namespace App\View\Components;

use App\Models\User;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(public User $user, public string $title)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.components.admin-layout');
    }
}
