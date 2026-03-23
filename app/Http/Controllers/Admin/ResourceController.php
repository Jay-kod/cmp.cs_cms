<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use App\Models\ResourceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        $categoryId = $request->query('category_id');

        $items = ResourceItem::query()
            ->with('category')
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->orderByDesc('uploaded_at')
            ->orderBy('sort_order')
            ->paginate(15)
            ->withQueryString();

        return view('admin.resources.index', [
            'categories' => $categories,
            'items' => $items,
            'selectedCategoryId' => $categoryId,
        ]);
    }

    public function create()
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        $resource = new ResourceItem();

        return view('admin.resources.form', [
            'resource' => $resource,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:resource_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt,xlsx|max:10240',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = ResourceCategory::query()->findOrFail($validated['category_id']);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());
        $safeBaseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeBaseName = Str::slug($safeBaseName) ?: 'resource';
        $filename = $safeBaseName . '_' . now()->format('YmdHis') . '_' . Str::random(8) . '.' . $ext;

        $storedPath = $file->storeAs("resources/{$category->slug}", $filename, 'public');

        $isActive = $validated['is_active'] ?? false;

        // Timetable category should only have one active resource at a time.
        if ($category->slug === 'timetable' && $isActive) {
            ResourceItem::query()->where('category_id', $category->id)->update(['is_active' => false]);
        }

        ResourceItem::create([
            'category_id' => $category->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $storedPath,
            'uploaded_at' => now(),
            'uploaded_by' => auth()->id(),
            'is_active' => $isActive,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.resources.index')->with('success', 'Resource uploaded successfully.');
    }

    public function edit(ResourceItem $resource)
    {
        $categories = ResourceCategory::query()
            ->orderBy('sort_order')
            ->get();

        return view('admin.resources.form', [
            'resource' => $resource,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, ResourceItem $resource)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:resource_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,txt,xlsx|max:10240',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = ResourceCategory::query()->findOrFail($validated['category_id']);
        $isActive = $validated['is_active'] ?? false;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());
            $safeBaseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeBaseName = Str::slug($safeBaseName) ?: 'resource';
            $filename = $safeBaseName . '_' . now()->format('YmdHis') . '_' . Str::random(8) . '.' . $ext;

            $storedPath = $file->storeAs("resources/{$category->slug}", $filename, 'public');

            // Remove previous file to avoid orphaned storage.
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }

            $resource->file_path = $storedPath;
            $resource->uploaded_at = now();
        }

        // Timetable single-active rule.
        if ($category->slug === 'timetable' && $isActive) {
            ResourceItem::query()
                ->where('category_id', $category->id)
                ->where('id', '!=', $resource->id)
                ->update(['is_active' => false]);
        }

        $resource->update([
            'category_id' => $category->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'is_active' => $isActive,
            'sort_order' => $validated['sort_order'] ?? 0,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.resources.index')->with('success', 'Resource updated successfully.');
    }

    public function destroy(ResourceItem $resource)
    {
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->route('admin.resources.index')->with('success', 'Resource deleted successfully.');
    }
}

