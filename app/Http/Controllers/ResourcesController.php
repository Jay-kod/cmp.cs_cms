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
            $items = ResourceItem::query()
                ->where('category_id', $category->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('uploaded_at')
                ->get();

            // Special case: Inject the directly uploaded timetable if it exists and this is the timetable category
            if ($category->slug === 'timetable') {
                $timetableFiles = \Illuminate\Support\Facades\Storage::disk('public')->files('timetable');
                if (!empty($timetableFiles)) {
                    $timetableFile = $timetableFiles[0];
                    $tItem = new ResourceItem([
                        'title' => 'Official Department Timetable',
                        'description' => 'The latest academic schedules and examination rosters for all levels.',
                        'file_path' => $timetableFile,
                    ]);
                    $tItem->uploaded_at = \Carbon\Carbon::createFromTimestamp(\Illuminate\Support\Facades\Storage::disk('public')->lastModified($timetableFile));
                    $tItem->created_at = $tItem->uploaded_at;
                    $items->prepend($tItem);
                }
            }

            $resourcesByCategory[$category->slug] = $items;
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

