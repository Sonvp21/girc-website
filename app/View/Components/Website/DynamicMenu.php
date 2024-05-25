<?php

namespace App\View\Components\Website;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicMenu extends Component
{
    public Category $category;

    public bool $isChild;

    public string $link;

    /**
     * Create a new component instance.
     */
    public function __construct(Category $category, bool $isChild = false)
    {
        $this->category = $category;
        $this->isChild = $isChild;
        $this->link = $this->getCategoryLink($category);
    }

    public function render(): View|Closure|string
    {
        return view('components.website.dynamic-menu');
    }

    /**
     * Get the appropriate link for the category.
     */
    private function getCategoryLink(Category $category): string
    {
        $postCount = $category->posts->count();
        if ($postCount == 1) {
            $post = $category->posts->first();

            return route('categories.posts.show', ['category' => $category->slug, 'post' => $post->slug]);
        } elseif ($postCount > 1) {
            return route('categories.posts.index', ['category' => $category->slug]);
        } else {
            return '#';
        }
    }
}
