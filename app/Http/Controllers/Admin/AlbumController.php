<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.albums.index', [
            'albums' => Album::query()
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
        return view('admin.albums.create');
    }

    public function store(AlbumRequest $request): RedirectResponse
    {
        $album = Album::create($request->all());

        return redirect()->route('admin.albums.index', compact('album'))->with('success', trans('admin.alerts.success.create'));
    }

    public function edit(Album $album): View
    {
        return view('admin.albums.edit')
            ->with([
                'album' => $album,
            ]);
    }

    public function update(AlbumRequest $request, Album $album): RedirectResponse
    {
        $album->update($request->all());

        return redirect()->route('admin.albums.index')->with('success', trans('admin.alerts.success.edit'));
    }

    public function destroy(Album $album): RedirectResponse
    {
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', trans('admin.alerts.success.deleted'));
    }
}
