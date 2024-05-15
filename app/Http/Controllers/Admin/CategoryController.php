<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index() : View
    {
        $categories = Category::orderBy('id')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return Factory|View
     */
    public function create() : View
    {
        return view('admin.categories.create');
    }

    /**
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::updateOrCreate(
            ['title' => $request->title],
            ['user_id' => auth()->id()]
        );

        if ($category->wasRecentlyCreated) {
            // Nếu là tạo mới
            return back()->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Category created successfully',
            ]);
        } else {
            // Nếu là cập nhật
            return back()->with([
                'icon' => 'info',
                'heading' => 'Updated',
                'message' => 'Category updated successfully',
            ]);
        }
        

        return back();
    }


    /**
     * @return Factory|View
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit')
            ->with([
                'category' => $category,
            ]);
    }

    /**
     * @return RedirectResponse
     */
    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Update successfully',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Category::destroy($request->id);

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'The data was successfully deleted',
        ]);
    }
}
