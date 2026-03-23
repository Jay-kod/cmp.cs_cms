<?php

namespace App\Http\Controllers;

use App\Models\ResourceCategory;
use App\Models\ResourceItem;

class ResourcesController extends Controller
{
    public function index()
    {
        $categories = ResourceCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $resourcesByCategory = [];

        foreach ($categories as $category) {
            $resourcesByCategory[$category->slug] = ResourceItem::query()
                ->where('category_id', $category->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('uploaded_at')
                ->get();
        }

        $timetableItem = $resourcesByCategory['timetable']?->first();

        // Pass categories + grouped items to keep the Blade simple.
        return view('pages.resources', [
            'categories' => $categories,
            'resourcesByCategory' => $resourcesByCategory,
            'timetableItem' => $timetableItem,
        ]);
    }
}

