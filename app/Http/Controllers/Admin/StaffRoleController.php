<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffRole;
use Illuminate\Http\Request;

class StaffRoleController extends Controller
{
    public function index()
    {
        $roles = StaffRole::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.staff-roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.staff-roles.form', ['role' => new StaffRole()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:staff_roles,name',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        StaffRole::create($data);

        return redirect()->route('admin.staff-roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(StaffRole $staffRole)
    {
        return view('admin.staff-roles.form', ['role' => $staffRole]);
    }

    public function update(Request $request, StaffRole $staffRole)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:staff_roles,name,' . $staffRole->id,
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $staffRole->update($data);

        return redirect()->route('admin.staff-roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(StaffRole $staffRole)
    {
        $staffRole->delete();
        return redirect()->route('admin.staff-roles.index')->with('success', 'Role deleted successfully.');
    }
}
