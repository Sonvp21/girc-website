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

    public function store(PostRequest $request): RedirectResponse
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
            // Tách các tag từ chuỗi JSON
            $tags = json_decode($request->tags);
            foreach ($tags as $tagObj) {
                $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
                $tagIds[] = $tag->id;
            }
            // Đồng bộ các tag với bài viết
            $post->tags()->sync($tagIds);
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $post ->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('featured_image');
        }
        // Redirect về danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * @return RedirectResponse
     */

     public function edit($id): View
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = $post->tags->pluck('name')->toArray();
        return view('admin.posts.edit', compact('tags', 'categories','post'));
    }
    public function update(Post $post, Request $request): RedirectResponse
{
    $post->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'content' => $request->content,
        'published_at' => $request->published_at,
    ]);
    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');
        $post->clearMediaCollection('featured_image');
        $post->addMedia($imageFile->getRealPath())
            ->usingFileName($imageFile->getClientOriginalName())
            ->usingName($imageFile->getClientOriginalName())
            ->toMediaCollection('featured_image');
    }
    // Đồng bộ tags cho bài viết
    if ($request->tags) {
        $tagIds = [];
        // Tách các tag từ chuỗi JSON
        $tags = json_decode($request->tags);
        foreach ($tags as $tagObj) {
            $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
            $tagIds[] = $tag->id;
        }
        // Đồng bộ các tag với bài viết
        $post->tags()->sync($tagIds);
    }
    

    return redirect()->route('admin.posts.index')->with([
        'icon' => 'success',
        'heading' => 'Success',
        'message' => 'Update successfully',
    ]);
}

public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Xóa các mối quan hệ trong bảng trung gian
    $post->tags()->detach();

    // Xóa bài viết
    $post->delete();

    // Xóa ảnh liên quan
    $post->clearMediaCollection('featured_image');

    // Kiểm tra và xóa các tag không còn được sử dụng
    $unusedTags = Tag::doesntHave('posts')->get();
    foreach ($unusedTags as $unusedTag) {
        $unusedTag->delete();
    }

    return back()->with([
        'icon' => 'success',
        'heading' => 'Success',
        'message' => trans('admin.alert.deleted-success'),
    ]);
}

}
