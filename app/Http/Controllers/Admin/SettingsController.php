<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentSetting;

class SettingsController extends Controller
{
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
