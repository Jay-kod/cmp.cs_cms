<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use App\Models\ResourceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourceItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        $categoryId = $request->query('category_id');

        $itemsQuery = ResourceItem::query()
            ->with('category')
            ->orderByDesc('id');

        if ($categoryId) {
            $itemsQuery->where('category_id', (int) $categoryId);
        }

        $items = $itemsQuery->paginate(15)->withQueryString();

        return view('admin.resources.index', [
            'items' => $items,
            'categories' => $categories,
            'categoryId' => $categoryId,
        ]);
    }

    public function create()
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        $item = new ResourceItem();

        return view('admin.resources.form', [
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:resource_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,xlsx,csv,doc,docx,txt|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = ResourceCategory::query()->findOrFail($validated['category_id']);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = Str::slug($validated['title']) . '-' . now()->timestamp . '.' . $ext;

        $directory = $category->slug === 'timetable'
            ? 'timetable'
            : 'resources/' . $category->slug;

        $storedPath = $file->storeAs($directory, $filename, 'public');

        $isActive = (bool) ($validated['is_active'] ?? false);

        if ($category->slug === 'timetable' && $isActive) {
            ResourceItem::query()
                ->where('category_id', $category->id)
                ->update(['is_active' => false]);
        }

        $resource = ResourceItem::create([
            'category_id' => $category->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $storedPath,
            'uploaded_at' => now(),
            'uploaded_by' => $request->user()?->id,
            'is_active' => $isActive,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Resource uploaded successfully.');
    }

    public function edit(ResourceItem $resource)
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        return view('admin.resources.form', [
            'item' => $resource,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, ResourceItem $resource)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:resource_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,xlsx,csv,doc,docx,txt|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = ResourceCategory::query()->findOrFail($validated['category_id']);

        $resource->category_id = $category->id;
        $resource->title = $validated['title'];
        $resource->description = $validated['description'] ?? null;
        $resource->is_active = (bool) ($validated['is_active'] ?? false);
        $resource->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            if ($resource->file_path) {
                // Best-effort delete old file; ignore if it was already removed.
                Storage::disk('public')->delete($resource->file_path);
            }

            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = Str::slug($validated['title']) . '-' . now()->timestamp . '.' . $ext;

            $directory = $category->slug === 'timetable'
                ? 'timetable'
                : 'resources/' . $category->slug;

            $storedPath = $file->storeAs($directory, $filename, 'public');
            $resource->file_path = $storedPath;
            $resource->uploaded_at = now();
        }

        if ($category->slug === 'timetable' && $resource->is_active) {
            ResourceItem::query()
                ->where('category_id', $category->id)
                ->update(['is_active' => false]);
            $resource->is_active = true;
        }

        $resource->uploaded_by = $request->user()?->id;
        $resource->save();

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Resource updated successfully.');
    }

    public function destroy(ResourceItem $resource)
    {
        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Resource deleted successfully.');
    }
}

