<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('is_system', 'desc')->orderBy('title')->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.form', ['page' => new Page()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'icon'       => 'nullable|string|max:100',
            'hero_image' => 'nullable|image|max:3072',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'is_active'  => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        if (!$request->has('is_active')) $data['is_active'] = false;
        
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('pages/heroes', 'public');
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('pages/attachments', 'public');
        }

        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'icon'       => 'nullable|string|max:100',
            'hero_image' => 'nullable|image|max:3072',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'is_active'  => 'boolean',
        ]);

        // Only update slug for non-system pages
        if (!$page->is_system) {
            $data['slug'] = Str::slug($data['title']);
        }
        if (!$request->has('is_active')) $data['is_active'] = false;

        if ($request->hasFile('hero_image')) {
            if ($page->hero_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($page->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('pages/heroes', 'public');
        }
        if ($request->has('remove_attachment')) {
            if ($page->attachment) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($page->attachment);
                $page->attachment = null;
            }
        }
        if ($request->hasFile('attachment')) {
            if ($page->attachment) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($page->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('pages/attachments', 'public');
        }

        $page->update($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->is_system) {
            return redirect()->route('admin.pages.index')->with('error', 'System pages cannot be deleted.');
        }

        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
