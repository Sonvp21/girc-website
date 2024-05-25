<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementsController extends Controller
{
    public function index(): View
    {
        return view('web.announcements.index', [
            'announcements' => Announcement::query()
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->paginate(6),
        ]);
    }

    public function show(Announcement $announcement): View
    {
        return view('web.announcements.show', [
            'announcement' => $announcement,
        ]);
    }
}
