<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showPost($category_slug, $post_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $post = Post::where('slug', $post_slug)->firstOrFail();

        return view('web.categories.show_post_first_category', compact('category', 'post'));
    }

    public function showAllPosts($category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(10);

        return view('web.categories.all_post_of_category', compact('category', 'posts'));
    }
}