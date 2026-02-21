<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Programme;
use App\Models\Staff;

class HomeController extends Controller
{
    public function index()
    {
        $programmes = Programme::where('is_active', true)->orderBy('sort_order')->get();
        $news = News::latest('published_at')->take(3)->get();
        $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
        $announcements = Announcement::where('expires_at', '>=', now())->orWhereNull('expires_at')->take(3)->get();
        
        $hod = Staff::where('is_hod', true)->first();
        $staffCount = Staff::where('is_active', true)->count();

        return view('pages.home', compact('programmes', 'news', 'events', 'announcements', 'hod', 'staffCount'));
    }
}
