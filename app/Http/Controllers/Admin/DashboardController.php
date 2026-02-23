<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Programme;
use App\Models\Course;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\GalleryAlbum;
use App\Models\NacosPresident;
use App\Models\PastHod;
use App\Models\Publication;

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
            'announcementsCount' => Announcement::count(),
            'albumsCount' => GalleryAlbum::count(),
            'presidentsCount' => NacosPresident::count(),
            'hodsCount' => PastHod::count(),
            'publicationsCount' => Publication::count(),
        ];
        
        $recentNews = News::latest()->take(5)->get();
        $upcomingEvents = Event::where('date', '>=', now())->orderBy('date')->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentNews', 'upcomingEvents'));
    }
}
