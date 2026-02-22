<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentSetting;
use App\Models\Staff;

class AboutController extends Controller
{
    public function index()
    {
        $settings = DepartmentSetting::where('group', 'about')->pluck('value', 'key');
        $hod = Staff::where('is_hod', true)->first();
        return view('pages.about', compact('settings', 'hod'));
    }

    public function pastHods()
    {
        $hods = \App\Models\PastHod::orderBy('tenure_end', 'desc')->get();
        return view('pages.past-hods', compact('hods'));
    }
}
