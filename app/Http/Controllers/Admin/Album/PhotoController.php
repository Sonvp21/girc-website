<?php

namespace App\Http\Controllers\Admin\Album;

use App\Enums\AlbumTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PhotoRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotoController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.albums.photos.index', [
            'photos' => Photo::query()
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
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::PHOTO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.photos.create', compact('albums'));
    }

    public function store(PhotoRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $photo = Photo::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $photo->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_photo');
        }

        return redirect()->route('admin.photos.index')->with('success', trans('admin.alerts.success.create'));
    }

    public function edit(Photo $photo): View
    {
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::PHOTO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.photos.edit')
            ->with([
                'photo' => $photo,
                'albums' => $albums,
            ]);
    }

    public function update(PhotoRequest $request, Photo $photo): RedirectResponse
    {
        $photo->update($request->all());

        if ($request->hasFile('image')) {
            $photo->clearMediaCollection('album_photo');
            $photo->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_photo');
        }

        return redirect()->route('admin.photos.index')->with('success', trans('admin.alerts.success.edit'));
    }

    public function destroy(Photo $photo): RedirectResponse
    {
        $photo->delete();

        return redirect()->route('admin.photos.index')->with('success', trans('admin.alerts.success.deleted'));
    }
}
