<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Staff\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(Request $request): View
    {
        $departments = Department::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
            )
            ->latest()
            ->get();

        return view('admin.staffs.departments.index', [
            'departments' => $departments,
        ]);
    }

    public function create(): View
    {
        $departments = Department::query()
            ->get();

        return view('admin.staffs.departments.create',
            [
                'departments' => $departments,
            ]);
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        $department = Department::create($request->all());

        return redirect()->route('admin.departments.index', compact('department'))->with('success', trans('admin.alerts.success.create'));
    }

    public function edit($id): View
    {
        $department = Department::findOrFail($id);

        return view('admin.staffs.departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->all());

        return redirect()->route('admin.departments.index')->with('success', trans('admin.alerts.success.edit'));
    }

    /**
     * Remove the specified Department only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department)
    {
        if ($department->staffs()->exists()) {
            return back()->with('success', trans('Department cannot be deleted because it has posts associated with it.'));
        }
        $department->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
