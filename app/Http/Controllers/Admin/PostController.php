<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $query = Post::latest();
        if ($request->has('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $posts = $query->paginate($perPage);
        $startIndex = ($posts->currentPage() - 1) * $perPage + 1;

        return view('admin.posts.index', compact('posts', 'startIndex'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags', 'categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = new Post([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ]);

        $post->save();

        if ($request->tags) {
            $tagIds = [];
            $tags = json_decode($request->tags);
            foreach ($tags as $tagObj) {
                $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $post->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('featured_image');
        }

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

        return view('admin.posts.edit', compact('tags', 'categories', 'post'));
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
        if ($request->tags) {
            $tagIds = [];
            $tags = json_decode($request->tags);
            foreach ($tags as $tagObj) {
                $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
                $tagIds[] = $tag->id;
            }
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
        $post->tags()->detach();
        $post->delete();
        $post->clearMediaCollection('featured_image');
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
