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
        return view('admin.scienceinformation.index', [
            'scienceinformations' => ScienceInformation::query()
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
        return view('admin.scienceinformation.create');
    }

    public function store(ScienceInformationRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $scienceinformation = ScienceInformation::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $scienceinformation->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('science_information_photo');
        }

        return redirect()->route('admin.scienceinformation.index', compact('scienceinformation'))->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return RedirectResponse
     */
    public function edit(ScienceInformation $scienceinformation): View
    {
        return view('admin.scienceinformation.edit', compact('scienceinformation'));
    }

    public function update(ScienceInformation $scienceinformation, ScienceInformationRequest $request): RedirectResponse
    {
        $scienceinformation->update($request->all());
        if ($request->hasFile('image')) {
            $scienceinformation->clearMediaCollection('science_information_photo');
            $scienceinformation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('science_information_photo');
        }

        return redirect()->route('admin.scienceinformation.index')->with('success', trans('admin.alerts.success.edit'));
    }

    public function destroy(ScienceInformation $scienceinformation)
    {
        $scienceinformation->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
