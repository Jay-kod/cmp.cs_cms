<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentSetting;
use Illuminate\Support\Facades\Storage;

class PageContentController extends Controller
{
    /**
     * Pages that have content editors.
     */
    private array $validPages = ['home', 'about', 'academics', 'blog', 'contact', 'nacos', 'people', 'gallery', 'past-hods', 'labs', 'siwes', 'projects'];

    /**
     * Show the content editor for a given page.
     */
    public function showPage(string $page)
    {
        abort_unless(in_array($page, $this->validPages), 404);

        // Load all settings for this page group plus common keys
        $settings = DepartmentSetting::whereIn('group', ["page_{$page}", 'hero'])
            ->pluck('value', 'key')
            ->toArray();

        return view("admin.page-content.{$page}", compact('settings', 'page'));
    }

    /**
     * Save content settings for a given page.
     */
    public function updatePage(Request $request, string $page)
    {
        abort_unless(in_array($page, $this->validPages), 404);

        $group = "page_{$page}";
        $imageGroup = 'hero';

        foreach ($request->except(['_token', '_method']) as $key => $value) {
            // Handle file uploads
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                // Delete old file if it exists
                $old = DepartmentSetting::where('key', $key)->value('value');
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $path = $file->store("site/page-content/{$page}", 'public');
                DepartmentSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path, 'group' => $imageGroup]
                );
                continue;
            }

            // Handle JSON repeater fields (submitted as arrays)
            if (is_array($value)) {
                $value = json_encode($value);
            }

            DepartmentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        return redirect()
            ->route('admin.page-content.show', $page)
            ->with('success', ucfirst($page) . ' page content updated successfully.');
    }
}
