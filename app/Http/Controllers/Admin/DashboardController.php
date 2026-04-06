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
use App\Models\MediaFile;
use App\Models\MediaDerivative;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Super admins get redirected to their own, more powerful dashboard
        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route('super-admin.dashboard');
        }

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
        
        $recentNews = News::withCount(['comments', 'reactions'])->latest()->take(5)->get();
        $upcomingEvents = Event::where('date', '>=', now())->orderBy('date')->take(5)->get();

        // Media optimization analysis (WebP derivatives)
        $mediaStatusCounts = MediaDerivative::query()
            ->where('format', 'webp')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $recentMedia = MediaFile::query()
            ->where('type', 'image')
            ->orderByDesc('id')
            ->take(6)
            ->with(['derivatives' => fn($q) => $q->where('format', 'webp')])
            ->get();

        $mediaLastConvertedAt = MediaDerivative::query()
            ->where('format', 'webp')
            ->where('status', 'ready')
            ->max('updated_at');

        $mediaLastFailedAt = MediaDerivative::query()
            ->where('format', 'webp')
            ->where('status', 'failed')
            ->max('updated_at');
        
        return view('admin.dashboard', compact(
            'stats',
            'recentNews',
            'upcomingEvents',
            'mediaStatusCounts',
            'recentMedia',
            'mediaLastConvertedAt',
            'mediaLastFailedAt'
        ));
    }
}
