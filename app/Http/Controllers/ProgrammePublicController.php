<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;

class ProgrammePublicController extends Controller
{
    public function show($slug)
    {
        $programme = Programme::with(['courses' => function ($query) {
            $query->orderBy('level')->orderBy('semester')->orderBy('code');
        }])->where('slug', $slug)
          ->where('is_active', true)
          ->firstOrFail();

        // Group courses by Level, then by Semester for the Curriculum tab/section
        $curriculum = $programme->courses->groupBy('level')->map(function ($coursesByLevel) {
            return $coursesByLevel->groupBy('semester');
        });

        return view('pages.programme-details', compact('programme', 'curriculum'));
    }
}
