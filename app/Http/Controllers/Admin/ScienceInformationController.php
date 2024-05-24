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
        return view('admin.science-information.index', [
            'scienceInformations' => ScienceInformation::query()
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
        return view('admin.science-information.create');
    }

    public function store(ScienceInformationRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $scienceInformation = ScienceInformation::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $scienceInformation->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('science_information_photo');
        }

        return redirect()->route('admin.science-information.index', compact('scienceInformation'))->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return RedirectResponse
     */
    public function edit(ScienceInformation $scienceInformation): View
    {
        return view('admin.science-information.edit', compact('scienceInformation'));
    }

    public function update(ScienceInformation $scienceInformation, ScienceInformationRequest $request): RedirectResponse
    {
        $scienceInformation->update($request->all());
        if ($request->hasFile('image')) {
            $scienceInformation->clearMediaCollection('science_information_photo');
            $scienceInformation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('science_information_photo');
        }

        return redirect()->route('admin.science-information.index')->with('success', trans('admin.alerts.success.edit'));
    }

    public function destroy(ScienceInformation $scienceInformation)
    {
        $scienceInformation->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
