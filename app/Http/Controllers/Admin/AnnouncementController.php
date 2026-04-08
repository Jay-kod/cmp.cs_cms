<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function settings()
    {
        $speed = \App\Models\DepartmentSetting::getCached('announcement_scroll_speed') ?? 10;
        
        // Fetch active announcements for the live preview
        $activeAnnouncements = Announcement::where(function($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        })->get();
        // Fallback for preview if none exist
        if ($activeAnnouncements->isEmpty()) {
            $activeAnnouncements = collect([
                (object)['id' => 1, 'title' => 'Test Announcement 1', 'is_urgent' => true, 'link' => '#', 'body' => 'This is a sample announcement body for the preview to test how the scroll speed looks on a real monitor.'],
                (object)['id' => 2, 'title' => 'Test Announcement 2', 'is_urgent' => false, 'link' => '#', 'body' => 'Make sure to check the speed to see if it allows enough time to read the text.'],
                (object)['id' => 3, 'title' => 'Test Announcement 3', 'is_urgent' => false, 'link' => null, 'body' => 'Another announcement string to ensure we have a realistic scroll width.'],
            ]);
        }
        
        return view('admin.announcements.settings', compact('speed', 'activeAnnouncements'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'speed' => 'required|integer|min:2|max:300',
        ]);
        
        \App\Models\DepartmentSetting::updateOrCreate(
            ['group' => 'branding', 'key' => 'announcement_scroll_speed'],
            ['value' => $request->speed]
        );
        \Illuminate\Support\Facades\Cache::forget('all_department_settings');
        
        // Determine the correct route based on the prefix
        $prefix = request()->route()->getPrefix();
        $routePrefix = $prefix === '/super-admin' ? 'super-admin.' : 'admin.';
        
        return redirect()->route($routePrefix . 'announcements.index')->with('success', 'Ticker settings updated successfully.');
    }

    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.form', ['announcement' => new Announcement()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'audience' => 'required|string|max:100',
            'priority' => 'required|in:low,normal,high',
            'expires_at' => 'nullable|date|after:today'
        ]);

        Announcement::create($data);
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement published successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'audience' => 'required|string|max:100',
            'priority' => 'required|in:low,normal,high',
            'expires_at' => 'nullable|date'
        ]);

        $announcement->update($data);
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
