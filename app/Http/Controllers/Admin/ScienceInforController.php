<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScienceInforRequest;
use App\Models\ScienceInfor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScienceInforController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.scienceinfors.index', [
            'scienceinfors' => ScienceInfor::query()
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
        return view('admin.scienceinfors.create');
    }

    public function store(ScienceInforRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $scienceinfor = ScienceInfor::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $scienceinfor->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('scienceinfor_photo');
        }

        return redirect()->route('admin.scienceinfors.index', compact('scienceinfor'))->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return RedirectResponse
     */
    public function edit(ScienceInfor $scienceinfor): View
    {
        return view('admin.scienceinfors.edit', compact('scienceinfor'));
    }

    public function update(ScienceInfor $scienceinfor, ScienceInforRequest $request): RedirectResponse
    {
        $scienceinfor->update($request->all());
        if ($request->hasFile('image')) {
            $scienceinfor->clearMediaCollection('scienceinfor_photo');
            $scienceinfor->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('scienceinfor_photo');
        }

        return redirect()->route('admin.scienceinfors.index')->with('success', trans('admin.alerts.success.edit'));

    }

    public function destroy(ScienceInfor $scienceinfor)
    {
        $scienceinfor->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
