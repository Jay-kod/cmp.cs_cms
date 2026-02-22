<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgrammeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgrammeCategoryController extends Controller
{
    public function index()
    {
        $categories = ProgrammeCategory::ordered()->withCount('programmes')->paginate(20);
        return view('admin.programme-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.programme-categories.form', ['category' => new ProgrammeCategory()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        if (!$request->has('is_active')) $data['is_active'] = false;
        if (!$request->has('sort_order')) $data['sort_order'] = 0;

        ProgrammeCategory::create($data);
        return redirect()->route('admin.programme-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProgrammeCategory $programme_category)
    {
        return view('admin.programme-categories.form', ['category' => $programme_category]);
    }

    public function update(Request $request, ProgrammeCategory $programme_category)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        if (!$request->has('is_active')) $data['is_active'] = false;
        if (!$request->has('sort_order')) $data['sort_order'] = 0;

        $programme_category->update($data);
        return redirect()->route('admin.programme-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProgrammeCategory $programme_category)
    {
        $programme_category->delete();
        return redirect()->route('admin.programme-categories.index')->with('success', 'Category deleted successfully.');
    }
}
