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

Route::get('/search', function (Request $request) {
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
        $results[] = ['title' => $p->name, 'subtitle' => $p->level . ' · ' . $p->duration, 'url' => '/academics#' . $p->slug, 'icon' => 'fa-solid fa-graduation-cap'];
    }

    // Search news
    $news = \App\Models\News::whereNotNull('published_at')
        ->where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('body', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($news as $n) {
        $results[] = ['title' => $n->title, 'subtitle' => 'News', 'url' => '/research-news', 'icon' => 'fa-solid fa-newspaper'];
    }

    // Search staff
    $staff = \App\Models\Staff::where(fn($query) => $query->where('name', 'like', "%{$q}%")->orWhere('specialization', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($staff as $s) {
        $results[] = ['title' => $s->name, 'subtitle' => $s->rank . ($s->specialization ? ' · ' . $s->specialization : ''), 'url' => '/people/' . $s->slug, 'icon' => 'fa-solid fa-user-tie'];
    }

    // Search events
    $events = \App\Models\Event::where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%"))
        ->limit(3)->get();
    foreach ($events as $e) {
        $results[] = ['title' => $e->title, 'subtitle' => 'Event', 'url' => '/research-news', 'icon' => 'fa-solid fa-calendar'];
    }

    // Search courses
    $courses = \App\Models\Course::where(fn($query) => $query->where('title', 'like', "%{$q}%")->orWhere('code', 'like', "%{$q}%"))
        ->limit(5)->get();
    foreach ($courses as $c) {
        $results[] = ['title' => $c->code . ' - ' . $c->title, 'subtitle' => 'Level ' . $c->level . ' · ' . $c->credit_units . ' Units', 'url' => '/academics#course-structure', 'icon' => 'fa-solid fa-book'];
    }

    // Static pages
    $pages = [
        ['title' => 'About Us', 'url' => '/about', 'icon' => 'fa-solid fa-info-circle', 'keywords' => 'about department story vision mission'],
        ['title' => 'Academics', 'url' => '/academics', 'icon' => 'fa-solid fa-graduation-cap', 'keywords' => 'academics programmes courses'],
        ['title' => 'Contact & Alumni', 'url' => '/contact-alumni', 'icon' => 'fa-solid fa-envelope', 'keywords' => 'contact alumni email phone'],
        ['title' => 'Blog / News & Events', 'url' => '/research-news', 'icon' => 'fa-solid fa-newspaper', 'keywords' => 'blog news events research publications'],
        ['title' => 'Faculty Members', 'url' => '/people', 'icon' => 'fa-solid fa-users', 'keywords' => 'faculty staff people lecturers professors'],
    ];
    foreach ($pages as $page) {
        if (stripos($page['keywords'], $q) !== false || stripos($page['title'], $q) !== false) {
            $results[] = ['title' => $page['title'], 'subtitle' => 'Page', 'url' => $page['url'], 'icon' => $page['icon']];
        }
    }

    return response()->json(['results' => array_slice($results, 0, 15)]);
});
