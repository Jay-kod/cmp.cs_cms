<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentSetting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = DepartmentSetting::where('group', 'about')->pluck('value', 'key');
        return view('pages.about', compact('settings'));
    }
}
