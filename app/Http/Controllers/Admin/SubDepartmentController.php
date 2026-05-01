<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubDepartmentController extends Controller
{
    public function index()
    {
        $departments = SubDepartment::orderBy('name')->paginate(20);
        return view('admin.sub-departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.sub-departments.form', ['department' => new SubDepartment()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sub_departments,slug',
            'prefix' => 'required|string|max:255|unique:sub_departments,prefix',
            'description' => 'nullable|string',
            'about_short' => 'nullable|string',
            'hod_name' => 'nullable|string|max:255',
            'hod_title' => 'nullable|string|max:255',
            'hod_message' => 'nullable|string',
            'hod_image' => 'nullable|image|max:2048',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'founded_year' => 'nullable|string|max:10',
            'faculty_name' => 'nullable|string|max:255',
            'student_population' => 'nullable|string|max:255',
            'programme_count' => 'nullable|string|max:255',
            'course_count' => 'nullable|string|max:255',
            'lecturer_count' => 'nullable|string|max:255',
            'career_pathways' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('hod_image');

        if ($request->hasFile('hod_image')) {
            $file = $request->file('hod_image');
            $filename = time() . '_' . Str::slug($request->name) . '_hod.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/departments'), $filename);
            $data['hod_image'] = 'images/departments/' . $filename;
        }

        SubDepartment::create($data);

        return redirect()->route('admin.sub-departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function show($id)
    {
        return redirect()->route('admin.sub-departments.edit', $id);
    }

    public function edit(SubDepartment $subDepartment)
    {
        return view('admin.sub-departments.form', ['department' => $subDepartment]);
    }

    public function update(Request $request, SubDepartment $subDepartment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sub_departments,slug,' . $subDepartment->id,
            'prefix' => 'required|string|max:255|unique:sub_departments,prefix,' . $subDepartment->id,
            'description' => 'nullable|string',
            'about_short' => 'nullable|string',
            'hod_name' => 'nullable|string|max:255',
            'hod_title' => 'nullable|string|max:255',
            'hod_message' => 'nullable|string',
            'hod_image' => 'nullable|image|max:2048',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'founded_year' => 'nullable|string|max:10',
            'faculty_name' => 'nullable|string|max:255',
            'student_population' => 'nullable|string|max:255',
            'programme_count' => 'nullable|string|max:255',
            'course_count' => 'nullable|string|max:255',
            'lecturer_count' => 'nullable|string|max:255',
            'career_pathways' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('hod_image');

        if ($request->hasFile('hod_image')) {
            $file = $request->file('hod_image');
            $filename = time() . '_' . Str::slug($request->name) . '_hod.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/departments'), $filename);
            $data['hod_image'] = 'images/departments/' . $filename;
            
            // Delete old image if needed
            if ($subDepartment->hod_image && file_exists(public_path($subDepartment->hod_image))) {
                @unlink(public_path($subDepartment->hod_image));
            }
        }

        $subDepartment->update($data);

        return redirect()->route('admin.sub-departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy(SubDepartment $subDepartment)
    {
        // Delete image first
        if ($subDepartment->hod_image && file_exists(public_path($subDepartment->hod_image))) {
            @unlink(public_path($subDepartment->hod_image));
        }
        $subDepartment->delete();
        return redirect()->route('admin.sub-departments.index')
                         ->with('success', 'Department deleted successfully.');
    }
}
