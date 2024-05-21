<?php

namespace App\View\Components\Admin\Sidebar;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Category::query()
            ->with('children')
            ->where('in_menu', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        return view('components.admin.sidebar.sidebar', [
            'categories' => $categories,
        ]);
    }
}
