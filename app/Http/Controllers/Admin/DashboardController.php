<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Programme;
use App\Models\Course;
use App\Models\News;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'staffCount' => Staff::count(),
            'programmesCount' => Programme::count(),
            'coursesCount' => Course::count(),
            'newsCount' => News::count(),
            'eventsCount' => Event::where('date', '>=', now())->count(),
        ];
        
        $recentNews = News::latest()->take(5)->get();
        $upcomingEvents = Event::where('date', '>=', now())->orderBy('date')->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentNews', 'upcomingEvents'));
    }
}
