<?php

namespace App\View\Components\Website;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class DynamicMenu extends Component
{
    public Category $category;
    public bool $isChild;
    public string $link;

    public function __construct(Category $category, bool $isChild = false)
    {
        $this->category = $category;
        $this->isChild = $isChild;
        $postCount = Cache::remember('category_posts_count_' . $category->id, now()->addMinutes(10), function () use ($category) {
            return $category->posts->count();
        });
        $this->link = $this->getCategoryLink($category, $postCount);
    }

    public function render(): View|Closure|string
    {
        return view('components.website.dynamic-menu');
    }

    private function getCategoryLink(Category $category, $postCount): string
    {
        if ($postCount == 1) {
            $post = Cache::remember('category_first_post_' . $category->id, now()->addMinutes(10), function () use ($category) {
                return $category->posts->first();
            });
            return route('categories.posts.show', ['category' => $category->slug, 'post' => $post->slug]);
        } elseif ($postCount > 1) {
            return route('categories.posts.index', ['category' => $category->slug]);
        } else {
            return '#';
        }
    }
}

