<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScienceInformationRequest;
use App\Models\ScienceInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScienceInformationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.scienceinfors.index', [
            'scienceinfors' => ScienceInformation::query()
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

    public function store(ScienceInformationRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $scienceinfor = ScienceInformation::create($request->all());

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
    public function edit(ScienceInformation $scienceinfor): View
    {
        return view('admin.scienceinfors.edit', compact('scienceinfor'));
    }

    public function update(ScienceInformation $scienceinfor, ScienceInformationRequest $request): RedirectResponse
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

    public function destroy(ScienceInformation $scienceinfor)
    {
        $scienceinfor->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
