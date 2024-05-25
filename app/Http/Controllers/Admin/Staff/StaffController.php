<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaffRequest;
use App\Models\Staff\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request): View
    {
        $staffs = Staff::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
            )
            ->latest()
            ->get();

        return view('admin.staffs.staff.index', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create(): View
    {
        return view('admin.staffs.staff.create');
    }

    public function store(StaffRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $staff = Staff::create($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(Staff $staff)
    {
        return view('admin.staffs.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(StaffRequest $request, Staff $staff)
    {
        $staff->update($request->all());

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->clearMediaCollection('staff_image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', trans('admin.alerts.success.edit'));
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staffs.index')->with('success', trans('admin.alerts.success.deleted'));
    }
}
