<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::orderBy('sort_order')->paginate(20);
        return view('admin.programmes.index', compact('programmes'));
    }

    public function create()
    {
        $categories = ProgrammeCategory::active()->ordered()->get();
        return view('admin.programmes.form', ['programme' => new Programme(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'department_code' => 'nullable|string|in:cs,cyb,ds',
            'programme_category_id' => 'nullable|exists:programme_categories,id',
            'level' => 'required|string|max:50',
            'duration' => 'required|string|max:50',
            'mode_of_study' => 'required|string|max:100',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'requirements_utme' => 'nullable|string',
            'requirements_de' => 'nullable|string',
            'career_pathways' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        $data['slug'] = Str::slug($data['name']);
        if(!$request->has('is_active')) $data['is_active'] = false;
        if(!$request->has('sort_order')) $data['sort_order'] = 0;

        Programme::create($data);
        return redirect()->route('admin.programmes.index')->with('success', 'Programme created successfully.');
    }

    public function edit(Programme $programme)
    {
        $categories = ProgrammeCategory::active()->ordered()->get();
        return view('admin.programmes.form', compact('programme', 'categories'));
    }

    public function update(Request $request, Programme $programme)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'department_code' => 'nullable|string|in:cs,cyb,ds',
            'programme_category_id' => 'nullable|exists:programme_categories,id',
            'level' => 'required|string|max:50',
            'duration' => 'required|string|max:50',
            'mode_of_study' => 'required|string|max:100',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'requirements_utme' => 'nullable|string',
            'requirements_de' => 'nullable|string',
            'career_pathways' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        $data['slug'] = Str::slug($data['name']);
        if(!$request->has('is_active')) $data['is_active'] = false;
        if(!$request->has('sort_order')) $data['sort_order'] = 0;

        $programme->update($data);
        return redirect()->route('admin.programmes.index')->with('success', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme)
    {
        $programme->delete();
        return redirect()->route('admin.programmes.index')->with('success', 'Programme deleted successfully.');
    }
}
