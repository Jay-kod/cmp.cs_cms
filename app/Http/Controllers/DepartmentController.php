<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function show($slug)
    {
        $departments = [
            'computer-science' => [
                'prefix' => 'cs',
                'name' => 'Department of Computer Science',
            ],
            'cyber-security' => [
                'prefix' => 'cyb',
                'name' => 'Department of Cyber Security',
            ],
            'data-science' => [
                'prefix' => 'ds',
                'name' => 'Department of Data Science',
            ],
        ];

        if (!array_key_exists($slug, $departments)) {
            abort(404);
        }

        $info = $departments[$slug];
        $deptPrefix = $info['prefix'];

        $programmes = \App\Models\Programme::where('department_code', $deptPrefix)->where('is_active', true)->get();
        $news = \App\Models\News::where('department_code', $deptPrefix)->latest('published_at')->take(3)->get();
        $albums = \App\Models\GalleryAlbum::where('department_code', $deptPrefix)->latest('date')->take(3)->get();
        // For staff HOD or similar, might rely on settings or specific query if needed
        
        return view('pages.department', [
            'departmentPrefix' => $deptPrefix,
            'departmentName' => $info['name'],
            'slug' => $slug,
            'programmes' => $programmes,
            'news' => $news,
            'albums' => $albums
        ]);
    }
}
