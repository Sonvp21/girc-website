<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Department;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request)
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
    public function create()
    {
        $departments = Department::all();

        return view('admin.staffs.staff.create', compact('departments'));
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'departments' => 'required|array',
            'departments.*' => 'exists:departments,id',
        ]);

        $staff = Staff::create($request->only(['name', 'content']));
        $staff->departments()->attach($request->departments);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', 'Staff created successfully.');
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(Staff $staff)
    {
        $departments = Department::all();

        return view('admin.staffs.staff.edit', compact('staff', 'departments'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'departments' => 'required|array',
            'departments.*' => 'exists:departments,id',
        ]);

        $staff->update($request->only(['name', 'content']));
        $staff->departments()->sync($request->departments);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->clearMediaCollection('staff_image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->departments()->detach();
        $staff->delete();

        return redirect()->route('admin.staffs.index')->with('success', 'Staff deleted successfully.');
    }
}
