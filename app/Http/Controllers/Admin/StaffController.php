<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\MediaOptimizationService;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderByDesc('is_hod')->orderBy('sort_order')->paginate(20);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $courses = Course::orderBy('code')->get();
        return view('admin.staff.form', ['staff' => new Staff(), 'courses' => $courses]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'rank' => 'required|string|max:100',
            'role' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:staff,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
            'specialisation' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Tenure,Visiting,Sabbatical',
            'bio' => 'nullable|string',
            'is_hod' => 'boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $courseIds = $data['courses'] ?? [];
        unset($data['courses']);


        if(!$request->has('is_hod')) $data['is_hod'] = false;
        if(!isset($data['status'])) $data['status'] = 'Tenure';

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $data['photo'] = $photoFile->store('public/staff_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);

            // Enqueue WebP optimization in the background.
            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['photo'],
                $photoFile->getClientMimeType()
            );
        }

        if($data['is_hod']) {
            Staff::where('is_hod', true)->update(['is_hod' => false]);
        }

        $staff = Staff::create($data);
        $staff->courses()->sync($courseIds);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(Staff $staff)
    {
        $staff->load('courses');
        $courses = Course::orderBy('code')->get();
        return view('admin.staff.form', compact('staff', 'courses'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'rank' => 'required|string|max:100',
            'role' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:staff,email,'.$staff->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
            'specialisation' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Tenure,Visiting,Sabbatical',
            'bio' => 'nullable|string',
            'is_hod' => 'boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $courseIds = $data['courses'] ?? [];
        unset($data['courses']);


        if(!$request->has('is_hod')) $data['is_hod'] = false;
        if(!isset($data['status'])) $data['status'] = 'Tenure';

        if ($request->hasFile('photo')) {
            if($staff->photo) Storage::delete('public/'.$staff->photo);
            $photoFile = $request->file('photo');
            $data['photo'] = $photoFile->store('public/staff_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);

            // Enqueue WebP optimization in the background.
            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['photo'],
                $photoFile->getClientMimeType()
            );
        }

        if($data['is_hod'] && !$staff->is_hod) {
            Staff::where('is_hod', true)->update(['is_hod' => false]);
        }

        $staff->update($data);
        $staff->courses()->sync($courseIds);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        if($staff->photo) Storage::delete('public/'.$staff->photo);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
