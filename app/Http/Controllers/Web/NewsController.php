<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('web.news.index', [
            'posts' => Post::query()
                ->with('category')
                ->published()
                ->orderByDesc('published_at')
                ->paginate(10),
        ]);
    }
}
