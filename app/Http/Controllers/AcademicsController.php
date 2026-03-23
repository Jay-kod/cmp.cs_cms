<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\Course;

class AcademicsController extends Controller
{
    public function index()
    {
        $programmes = Programme::with('category')
            ->where('is_active', true)
            ->get();

        $courses = Course::with('programme')->orderBy('semester')->get()->groupBy('level');

        return view('pages.academics', compact('programmes', 'courses'));
    }
}
