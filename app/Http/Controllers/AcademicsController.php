<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;
use App\Models\Course;

class AcademicsController extends Controller
{
    public function index()
    {
        $programmes = Programme::where('is_active', true)->orderBy('sort_order')->get();
        $undergrad = $programmes->where('level', 'BSc');
        $postgrad = $programmes->whereIn('level', ['MSc', 'PhD']);
        $courses = Course::with('programme')->orderBy('semester')->get()->groupBy('level'); 
        
        return view('pages.academics', compact('programmes', 'undergrad', 'postgrad', 'courses'));
    }
}
