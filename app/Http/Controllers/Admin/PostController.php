<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $query = Post::latest();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->paginate($perPage);
        $startIndex = ($posts->currentPage() - 1) * $perPage + 1;
        return view('admin.posts.index', compact('posts', 'startIndex'));
    }

    public function create() : View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags','categories'));
    }

    public function store(Request $request): RedirectResponse
{
    // Tạo bài viết mới
    $post = new Post([
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'content' => $request->content,
        'published_at' => $request->published_at,
    ]);

    $post->save();

    // Đồng bộ tags cho bài viết
    if ($request->tags) {
        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);
    }

    // Redirect về danh sách bài viết với thông báo thành công
    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
}

    /**
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        // Tìm và xóa danh mục dựa trên id
        $Post = Post::findOrFail($id);
        $Post->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
