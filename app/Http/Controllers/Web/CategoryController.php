<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function showPost(Category $category, Post $post)
    {
        $post = Post::where('slug', $post->slug)->firstOrFail();

        return view('web.categories.show_post_first_category', compact('category', 'post'));
    }

    public function showAllPosts(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('web.categories.all_post_of_category', compact('category', 'posts'));
    }
}
