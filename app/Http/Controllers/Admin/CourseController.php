<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Programme;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('programme');
        
        if ($request->filled('programme_id')) {
            $query->where('programme_id', $request->programme_id);
        }
        
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $courses = $query->orderBy('level')->orderBy('semester')->orderBy('code')->paginate(30);
        $programmes = Programme::orderBy('name')->get();
        
        return view('admin.courses.index', compact('courses', 'programmes'));
    }

    public function create()
    {
        $programmes = Programme::orderBy('name')->get();
        return view('admin.courses.form', ['course' => new Course(), 'programmes' => $programmes]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'programme_id' => 'required|exists:programmes,id',
            'code' => 'required|string|max:20|unique:courses,code',
            'title' => 'required|string|max:255',
            'credit_units' => 'required|integer|min:1|max:10',
            'level' => 'required|integer',
            'semester' => 'required|in:1,2',
            'is_elective' => 'boolean',
            'description' => 'nullable|string'
        ]);

        if(!$request->has('is_elective')) $data['is_elective'] = false;

        $course = Course::create($data);
        return redirect()->route('admin.courses.index', ['programme_id' => $course->programme_id])->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $programmes = Programme::orderBy('name')->get();
        return view('admin.courses.form', compact('course', 'programmes'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'programme_id' => 'required|exists:programmes,id',
            'code' => 'required|string|max:20|unique:courses,code,'.$course->id,
            'title' => 'required|string|max:255',
            'credit_units' => 'required|integer|min:1|max:10',
            'level' => 'required|integer',
            'semester' => 'required|in:1,2',
            'is_elective' => 'boolean',
            'description' => 'nullable|string'
        ]);

        if(!$request->has('is_elective')) $data['is_elective'] = false;

        $course->update($data);
        return redirect()->route('admin.courses.index', ['programme_id' => $course->programme_id])->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $programme_id = $course->programme_id;
        $course->delete();
        return redirect()->route('admin.courses.index', ['programme_id' => $programme_id])->with('success', 'Course deleted successfully.');
    }
}
