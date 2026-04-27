<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Programme;
use App\Models\DepartmentSetting;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if (!$page->is_active) {
            abort(404);
        }

        if ($page->slug === 'programmes') {
            $programmes = Programme::where('is_active', true)->orderBy('sort_order')->get();
            $settings = DepartmentSetting::whereIn('group', ['page_programmes', 'hero'])->pluck('value', 'key')->toArray();
            return view('pages.programmes', compact('page', 'programmes', 'settings'));
        }

        return view('pages.page', compact('page'));
    }
}
