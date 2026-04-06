<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TimetableController extends Controller
{
    public function showUpload()
    {
        $currentTimetable = null;
        $files = Storage::disk('public')->files('timetable');
        if (!empty($files)) {
            $currentTimetable = basename($files[0]);
        }
        return view('admin.page-content.timetable-upload', compact('currentTimetable'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'timetable' => 'required|file|mimes:pdf,xlsx,csv,jpg,jpeg,png,webp,gif|max:5120',
        ]);
        // Remove old timetable
        $files = Storage::disk('public')->files('timetable');
        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }
        $file = $request->file('timetable');
        $filename = 'department-timetable.' . $file->getClientOriginalExtension();
        $file->storeAs('timetable', $filename, 'public');
        return redirect()->route('admin.timetable.upload')->with('success', 'Timetable uploaded successfully!');
    }
}
