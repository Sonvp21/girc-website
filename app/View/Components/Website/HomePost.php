<?php

namespace App\View\Components\Website;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class HomePost extends Component
{
    public function render(): View|Closure|string
    {
        $posts = Cache::remember('home_category_posts', now()->addMinutes(10), function () {
            return Post::query()
                ->with('category')
                ->published()
                ->whereHas('category', function ($query) {
                    $query->whereId(config('app.home_category_id'));
                })
                ->latest('published_at')
                ->take(5)
                ->get();
        });

        return view('components.website.home-post', [
            'posts' => $posts,
            'latestPost' => $posts->first(),
        ]);
    }
}
