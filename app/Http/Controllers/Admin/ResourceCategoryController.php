<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;

class ResourceCategoryController extends Controller
{
    public function index()
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        return view('admin.resource-categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new ResourceCategory();

        return view('admin.resource-categories.form', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:100|unique:resource_categories,slug',
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        ResourceCategory::create([
            'slug' => $validated['slug'],
            'name' => $validated['name'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->route('admin.resource-categories.index')->with('success', 'Resource category created.');
    }

    public function edit(ResourceCategory $resourceCategory)
    {
        return view('admin.resource-categories.form', [
            'category' => $resourceCategory,
        ]);
    }

    public function update(Request $request, ResourceCategory $resourceCategory)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:100|unique:resource_categories,slug,' . $resourceCategory->id,
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $resourceCategory->update([
            'slug' => $validated['slug'],
            'name' => $validated['name'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->route('admin.resource-categories.index')->with('success', 'Resource category updated.');
    }

    public function destroy(ResourceCategory $resourceCategory)
    {
        $resourceCategory->delete();

        return redirect()->route('admin.resource-categories.index')->with('success', 'Resource category deleted.');
    }
}

