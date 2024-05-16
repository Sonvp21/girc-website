<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $query = Announcement::latest();
        if ($request->has('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $announcements = $query->paginate($perPage);
        $startIndex = ($announcements->currentPage() - 1) * $perPage + 1;

        return view('admin.announcements.index', compact('announcements', 'startIndex'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request): RedirectResponse
    {
        $announcement = new Announcement([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $announcement->save();

        return redirect()->route('admin.announcements.index');
    }

    /**
     * @return RedirectResponse
     */
    public function edit($id): View
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $announcement, Request $request): RedirectResponse
    {
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.announcements.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Update successfully',
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
