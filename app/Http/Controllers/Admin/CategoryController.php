<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.categories.index', [
            'categories' => Category::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('title', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create(): View
    {
        $categories = Category::where('parent_id', null)->orderBy('order')->get();

        return view('admin.categories.create',
            [
                'categories' => $categories,
            ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = [
            'title_en' => $request->title_en,
            'parent_id' => $request->parent_id,
            'in_menu' => $request->in_menu,
            'user_id' => auth()->id(),
        ];
        if ($request->filled('order')) {
            $data['order'] = $request->order;
        }
        $category = Category::updateOrCreate(
            ['title' => $request->title],
            $data
        );
        if ($category->wasRecentlyCreated) {
            return back()->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Category created successfully',
            ]);
        } else {
            return back()->with([
                'icon' => 'info',
                'heading' => 'Updated',
                'message' => 'Category updated successfully',
            ]);
        }
    }


    /**
     * @return Factory|View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', null)->where('id', '!=', $id)->orderBy('order')->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }


    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->update([
            'order' => $request->order,
            'title' => $request->title,
            'title_en' => $request->title_en,
            'parent_id' => $request->parent_id ?: null,
            'in_menu' => $request->in_menu,
        ]);

        return redirect()->route('admin.categories.index')->with([
            'icon' => 'success',
            'message' => 'Category updated successfully'
        ]);
    }


    /**
     * Remove the specified category only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->posts()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => 'Category cannot be deleted because it has posts associated with it.',
            ]);
        }
        $category->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('Deleted success'),
        ]);
    }

    
    
}
