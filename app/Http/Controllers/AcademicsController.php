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
        $categories = ProgrammeCategory::active()
            ->ordered()
            ->with(['programmes' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order');
            }])
            ->get();

        $courses = Course::with('programme')->orderBy('semester')->get()->groupBy('level');

        return view('pages.academics', compact('categories', 'courses'));
    }
}
