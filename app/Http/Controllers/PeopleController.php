<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class PeopleController extends Controller
{
    public function index()
    {
        $hod = Staff::where('is_hod', true)->first();
        $academicStaff = Staff::where('is_active', true)
            ->whereNotIn('rank', ['Technical Staff', 'Administrative Staff', 'Technologist'])
            ->orderBy('sort_order')
            ->get();
        // Just for simplicity, assuming anyone not matched above is technical/admin
        $technicalStaff = Staff::where('is_active', true)
            ->whereIn('rank', ['Technical Staff', 'Administrative Staff', 'Technologist'])
            ->orderBy('sort_order')
            ->get();
        
        return view('pages.people.index', compact('hod', 'academicStaff', 'technicalStaff'));
    }

    public function show($slug)
    {
        $staff = Staff::where('slug', $slug)
            ->with(['qualifications' => fn($q) => $q->orderByDesc('year'), 
                    'publications' => fn($q) => $q->orderByDesc('year'), 
                    'courses'])
            ->firstOrFail();
            
        return view('pages.people.show', compact('staff'));
    }
}
