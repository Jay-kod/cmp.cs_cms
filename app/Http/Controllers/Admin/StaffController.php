<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('sort_order')->paginate(20);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.form', ['staff' => new Staff()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'rank' => 'required|string|max:100',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:50',
            'specialisation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'is_hod' => 'boolean',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:2048'
        ]);

        $data['slug'] = Str::slug($data['name']);
        if(!$request->has('is_hod')) $data['is_hod'] = false;
        if(!$request->has('is_active')) $data['is_active'] = false;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/staff_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);
        }

        if($data['is_hod']) {
            Staff::where('is_hod', true)->update(['is_hod' => false]);
        }

        Staff::create($data);
        return redirect()->route('admin.staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.form', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'rank' => 'required|string|max:100',
            'email' => 'required|email|unique:staff,email,'.$staff->id,
            'phone' => 'nullable|string|max:50',
            'specialisation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'is_hod' => 'boolean',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:2048'
        ]);

        $data['slug'] = Str::slug($data['name']);
        if(!$request->has('is_hod')) $data['is_hod'] = false;
        if(!$request->has('is_active')) $data['is_active'] = false;

        if ($request->hasFile('photo')) {
            if($staff->photo) Storage::delete('public/'.$staff->photo);
            $data['photo'] = $request->file('photo')->store('public/staff_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);
        }

        if($data['is_hod'] && !$staff->is_hod) {
            Staff::where('is_hod', true)->update(['is_hod' => false]);
        }

        $staff->update($data);
        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        if($staff->photo) Storage::delete('public/'.$staff->photo);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
