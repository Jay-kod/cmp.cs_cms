<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentSetting;

class SettingsController extends Controller
{
    public function brandLogo()
    {
        return view('admin.settings.brand-logo');
    }

    public function updateBrandLogo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            $request->file('logo')->move(public_path('images'), 'logo.png');
        }

        if ($request->hasFile('favicon')) {
            $request->file('favicon')->move(public_path('images'), 'logo-favicon.png');
        }

        return back()->with('success', 'Brand Identity updated successfully.');
    }

    public function updateAcademicSession(Request $request)
    {
        $request->validate([
            'academic_session' => 'required|string|max:255',
            'academic_semester' => 'required|string|max:255'
        ]);

        DepartmentSetting::updateOrCreate(
            ['key' => 'academic_session'],
            ['value' => $request->academic_session, 'group' => 'general']
        );
        
        DepartmentSetting::updateOrCreate(
            ['key' => 'academic_semester'],
            ['value' => $request->academic_semester, 'group' => 'general']
        );

        return back()->with('success', 'Academic session and semester updated successfully.');
    }
}
