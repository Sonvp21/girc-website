<?php

namespace App\Http\Controllers\Admin\Album;

use App\Enums\AlbumTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.videos.index', [
            'videos' => Video::query()
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
            ->where('type', AlbumTypeEnum::VIDEO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.videos.create', compact('albums'));
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required'
        ]);
        $video = Video::create($request->all());
        
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $video->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_video');
        }

        return redirect()->route('admin.videos.index')->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return Factory|View
     */
    public function edit(Video $video): View
    {
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::VIDEO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.videos.edit')
            ->with([
                'video' => $video,
                'albums' => $albums,
            ]);
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $video->update($request->all());

        if ($request->hasFile('image')) {
            $video->clearMediaCollection('album_video');
            $video->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_video');
        }

        return redirect()->route('admin.videos.index')->with('success', trans('admin.alerts.success.edit'));
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', trans('admin.alerts.success.deleted'));
    }
}
