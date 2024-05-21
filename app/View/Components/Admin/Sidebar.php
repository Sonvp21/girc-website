<?php

namespace App\View\Components\Admin;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::query()
            ->where('in_menu', true)
            ->orderBy('order')
            ->get();
    
        $categoryTree = $this->buildCategoryTree($categories);
    
        return view('components.admin.sidebar', [
            'categoryTree' => $categoryTree,
        ]);
    }
    
    private function buildCategoryTree($categories, $parentId = null)
    {
        $branch = collect();
    
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategoryTree($categories, $category->id);
                if ($children->isNotEmpty()) {
                    $category->children = $children;
                }
                $branch->push($category);
            }
        }
    
        return $branch;
    }
    
}
