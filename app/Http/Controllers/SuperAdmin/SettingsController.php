<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = DepartmentSetting::all()->groupBy('group');
        return view('super-admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        $colorKeys = ['color_primary', 'color_secondary', 'color_accent'];
        
        foreach ($data as $key => $value) {
            $group = in_array($key, $colorKeys) ? 'branding' : 'general';
            DepartmentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value, 'group' => $group]
            );
        }

        return redirect()->route('super-admin.settings.index')->with('success', 'Department settings updated successfully.');
    }
}
