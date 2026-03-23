<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ── Content freshness check (used by auto-refresh on public pages) ──
Route::get('/content-updated', function () {
    $latest = collect([
        \App\Models\News::max('updated_at'),
        \App\Models\Event::max('updated_at'),
        \App\Models\Announcement::max('updated_at'),
        \App\Models\Staff::max('updated_at'),
        \App\Models\Programme::max('updated_at'),
        \App\Models\Course::max('updated_at'),
        \App\Models\CarouselSlide::max('updated_at'),
        \App\Models\GalleryAlbum::max('updated_at'),
        \App\Models\Partner::max('updated_at'),
        \App\Models\Publication::max('updated_at'),
        \App\Models\NacosPresident::max('updated_at'),
        \App\Models\PastHod::max('updated_at'),
        \App\Models\Page::max('updated_at'),
        \App\Models\DepartmentSetting::max('updated_at'),
    ])->filter()->max();

    return response()->json([
        'updated_at' => $latest,
        'ts'         => $latest ? strtotime($latest) : 0,
    ]);
});

Route::get('/search', function (Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'q' => 'nullable|string|max:100',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $q = $request->input('q', '');
    if (strlen($q) < 2) {
        return response()->json(['results' => []]);
    }

    $results = [];

    // Search programmes
    $programmes = \App\Models\Programme::where('is_active', true)
        ->where(fn($query) => $query->where('name', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($programmes as $p) {
        $results[] = ['title' => $p->name, 'subtitle' => $p->level . ' · ' . $p->duration, 'url' => '/academics#' . $p->slug, 'icon' => 'fa-solid fa-graduation-cap', 'type' => 'Programme'];
    }

    // Search news
    $news = \App\Models\News::whereNotNull('published_at')
        ->where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('body', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($news as $n) {
        $results[] = ['title' => $n->title, 'subtitle' => 'News', 'url' => '/research-news', 'icon' => 'fa-solid fa-newspaper', 'type' => 'News'];
    }

    // Search staff
    $staff = \App\Models\Staff::where(fn($query) => $query->where('name', 'like', "%{$q}%")->orWhere('specialisation', 'like', "%{$q}%")->orWhere('rank', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($staff as $s) {
        $results[] = ['title' => ($s->title ? $s->title . ' ' : '') . $s->name, 'subtitle' => $s->rank . ($s->specialisation ? ' · ' . $s->specialisation : ''), 'url' => '/people/' . $s->slug, 'icon' => 'fa-solid fa-user-tie', 'type' => 'Staff'];
    }

    // Search events
    $events = \App\Models\Event::where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%"))
        ->limit(3)->get();
    foreach ($events as $e) {
        $results[] = ['title' => $e->title, 'subtitle' => 'Event', 'url' => '/research-news', 'icon' => 'fa-solid fa-calendar', 'type' => 'Event'];
    }

    // Search courses
    $courses = \App\Models\Course::where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('code', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($courses as $c) {
        $results[] = ['title' => $c->code . ' - ' . $c->title, 'subtitle' => 'Level ' . $c->level . ' · ' . $c->credit_units . ' Units', 'url' => '/academics#course-structure', 'icon' => 'fa-solid fa-book', 'type' => 'Course'];
    }

    // Static pages
    $pages = [
        ['title' => 'About Us', 'url' => '/about', 'icon' => 'fa-solid fa-info-circle', 'keywords' => 'about department story vision mission'],
        ['title' => 'Academics', 'url' => '/academics', 'icon' => 'fa-solid fa-graduation-cap', 'keywords' => 'academics programmes courses'],
        ['title' => 'Contact', 'url' => '/contact', 'icon' => 'fa-solid fa-envelope', 'keywords' => 'contact email phone department'],
        ['title' => 'Blog / News & Events', 'url' => '/research-news', 'icon' => 'fa-solid fa-newspaper', 'keywords' => 'blog news events research publications'],
        ['title' => 'Faculty Members', 'url' => '/people', 'icon' => 'fa-solid fa-users', 'keywords' => 'faculty staff people lecturers professors'],
    ];
    foreach ($pages as $page) {
        if (stripos($page['keywords'], $q) !== false || stripos($page['title'], $q) !== false) {
            $results[] = ['title' => $page['title'], 'subtitle' => 'Page', 'url' => $page['url'], 'icon' => $page['icon'], 'type' => 'Page'];
        }
    }

    return response()->json(['results' => array_slice($results, 0, 15)]);
});
