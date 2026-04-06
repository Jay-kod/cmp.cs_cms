<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function show($slug)
    {
        $subDept = \App\Models\SubDepartment::where('slug', $slug)->active()->firstOrFail();
        $deptPrefix = $subDept->prefix;

        $mainDept = \App\Models\SubDepartment::where('slug', 'computer-science')->first() ?? $subDept;

        // Force all HOD information to be the same dynamically, utilizing the major department (Computer Science)
        $subDept->hod_name = $mainDept->hod_name;
        $subDept->hod_title = $mainDept->hod_title ?: "Head of {$mainDept->name}";
        $subDept->hod_image = $mainDept->hod_image;
        $subDept->hod_message = $mainDept->hod_message ?: "Welcome to {$mainDept->name}. We are committed to fostering learning, cutting-edge research, and critical problem-solving skills.";

        $programmes = \App\Models\Programme::with('courses')->where('department_code', $deptPrefix)->where('is_active', true)->get();
        $news = \App\Models\News::where('department_code', $deptPrefix)->latest('published_at')->take(3)->get();
        $albums = \App\Models\GalleryAlbum::where('department_code', $deptPrefix)->latest('date')->take(3)->get();
        
        // Coordinator / Staff
        // Retrieve staff associated with these programmes -> courses
        $programmeIds = $programmes->pluck('id');
        $staff = \App\Models\Staff::whereHas('courses', function ($query) use ($programmeIds) {
            $query->whereIn('programme_id', $programmeIds);
        })->get();

        // If no staff explicitly linked, fallback to all staff for the time being or staff from main dept?
        // For Cyber Security sub-department, let's load all for now if none found, to avoid empty states
        if ($staff->isEmpty()) {
             $staff = \App\Models\Staff::all();
        }
        
        $staffIds = $staff->pluck('id');
        $publications = \App\Models\Publication::whereIn('staff_id', $staffIds)->latest('year')->take(10)->get();

        return view('pages.department', [
            'departmentPrefix' => $deptPrefix,
            'subDept' => $subDept,
            'slug' => $slug,
            'programmes' => $programmes,
            'news' => $news,
            'albums' => $albums,
            'staff' => $staff,
            'publications' => $publications
        ]);
    }
}
