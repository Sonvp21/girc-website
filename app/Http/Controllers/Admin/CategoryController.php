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
    public function index(Request $request): View
    {
        $categories = Category::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%'.$request->search.'%')
            )
            ->latest()
            ->get();

        $buildCategoryTree = $this->buildCategoryTree($categories);

        return view('admin.categories.index', [
            'categories' => $categories,
            'buildCategoryTree' => $buildCategoryTree,
        ]);
    }

    public function create(): View
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('in_menu', true)
            ->orderBy('order')->get();

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

    public function edit($id): View
    {
        $selectedCategory = Category::findOrFail($id);

        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('in_menu', true)
            ->orderBy('order')->get();

        return view('admin.categories.edit', compact('categories', 'selectedCategory'));
    }

    private function renderCategoryOptions($categories, $level = 0)
    {
        $html = '';
        foreach ($categories as $category) {
            $indentClass = 'level-'.$level;
            $html .= '<option class="'.$indentClass.'" value="'.$category->id.'">'.htmlspecialchars($category->name).'</option>';
            if ($category->recursiveChildren->isNotEmpty()) {
                $html .= $this->renderCategoryOptions($category->recursiveChildren, $level + 1);
            }
        }

        return $html;
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
            'message' => 'Category updated successfully',
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

    private function buildCategoryTree($categories, $parentId = null)
    {
        $branch = collect();

        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategoryTree($categories, $category->id);
                if ($children->isNotEmpty()) {
                    $category->children = $children;
                }
                $branch->push($category);
            }
        }

        return $branch;
    }
}
