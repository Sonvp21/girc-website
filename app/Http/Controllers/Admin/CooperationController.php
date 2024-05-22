<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CooperationRequest;
use App\Models\Album;
use App\Models\Cooperation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CooperationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.cooperations.index', [
            'cooperations' => Cooperation::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
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
        return view('admin.albums.cooperations.create');
    }

    public function store(CooperationRequest $request)
    {
        $cooperation = new Cooperation([
            'name' => $request->name,
            'link_website' => $request->link_website,
            'description' => $request->description,
        ]);
        $cooperation->save();
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation created successfully.');
    }

    /**
     * @return Factory|View
     */
    public function edit($id): View
    {
        $cooperation = Cooperation::findOrFail($id);
        return view('admin.albums.cooperations.edit', compact('cooperation'));
    }

    public function update(Request $request, Cooperation $cooperation)
    {

        $cooperation->update([
            'name' => $request->name,
            'link_website' => $request->link_website,
            'description' => $request->description,
        ]);
        if ($request->hasFile('image')) {
            $cooperation->clearMediaCollection('album_cooperation');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation updated successfully.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Cooperation $cooperation)
    {
        $cooperation->delete();
        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation deleted successfully.');
    }
}
