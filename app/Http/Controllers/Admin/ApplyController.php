<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ApplyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Apply;

class ApplyController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.applies.index', [
            'applies' => Apply::query()
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
        return view('admin.applies.create');
    }

    public function store(ApplyRequest $request): RedirectResponse
    {
        Apply::create($request->all());

        return redirect()->route('admin.applies.index')->with('success', trans('admin.alerts.success.create'));
    }

    public function destroy(Apply $apply): RedirectResponse
    {
        $apply->delete();

        return redirect()->route('admin.applies.index')->with('success', trans('admin.alerts.success.deleted'));
    }

}
