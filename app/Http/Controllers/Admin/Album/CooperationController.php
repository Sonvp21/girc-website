<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CooperationRequest;
use App\Models\Cooperation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CooperationController extends Controller
{
    public function index(Request $request): View
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

    public function create(): View
    {
        return view('admin.albums.cooperations.create');
    }

    public function store(CooperationRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $cooperation = Cooperation::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', trans('admin.alerts.success.create'));
    }

    public function edit(Cooperation $cooperation): View
    {
        return view('admin.albums.cooperations.edit')->with([
            'cooperation' => $cooperation,
        ]);
    }

    public function update(CooperationRequest $request, Cooperation $cooperation): RedirectResponse
    {
        $cooperation->update($request->all());

        if ($request->hasFile('image')) {
            $cooperation->clearMediaCollection('album_cooperation');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', trans('admin.alerts.success.edit'));
    }

    public function destroy(Cooperation $cooperation): RedirectResponse
    {
        $cooperation->delete();

        return redirect()->route('admin.cooperations.index')->with('success', trans('admin.alerts.success.deleted'));
    }
}
