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
        return view('admin.announcements.index', [
            'announcements' => Announcement::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('title', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request): RedirectResponse
    {
        $announcement = Announcement::create($request->all());

        return redirect()->route('admin.announcements.index', compact('announcement'))->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return RedirectResponse
     */
    public function edit($id): View
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Announcement $announcement, Request $request): RedirectResponse
    {
        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')->with('success', trans('admin.alerts.success.edit'));

    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
