<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;
use App\Models\DepartmentSetting;

class AdmissionsController extends Controller
{
    public function index()
    {
        $programmes = Programme::with('category')
            ->where('is_active', true)
            ->get();

        $settings = DepartmentSetting::whereIn('group', ['admissions', 'page_admissions', 'about', 'contact'])
            ->pluck('value', 'key');

        return view('pages.admissions', compact('programmes', 'settings'));
    }
}
