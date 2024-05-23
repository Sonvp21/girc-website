<?php

namespace App\View\Components\Website;

use App\Services\CategoryService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.website.menu', [
            'categories' => $this->categoryService->getCachedCategoriesForMenu(),
        ]);
    }
}
