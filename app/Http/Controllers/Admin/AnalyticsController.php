<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\Course;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use App\Models\Publication;
use App\Models\NacosPresident;
use App\Models\PastHod;
use App\Models\Page;
use App\Models\ExternalSystem;
use App\Models\SocialLink;
use App\Models\CarouselSlide;
use App\Models\Reaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AnalyticsController extends Controller
{
    /**
     * Show the analytics dashboard.
     */
    public function index()
    {
        $data = Cache::remember('analytics_stats', 600, fn() => $this->gatherAllStats());
        return view('admin.analytics.index', $data);
    }

    /**
     * Download a report (individual or all).
     */
    public function download(Request $request)
    {
        $section = $request->input('section', 'all');
        $stats = $this->gatherAllStats();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.analytics.pdf', compact('section', 'stats'));

        $filename = $section === 'all'
            ? 'department_full_report_' . now()->format('Y-m-d') . '.pdf'
            : "department_{$section}_report_" . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    // ─── Data Gathering ────────────────────────────────────────

    private function gatherAllStats(): array
    {
        // Staff
        $staff = Staff::all();
        $staffCount = $staff->count();
        $activeStaff = $staff->where('is_active', true)->count();
        $hodStaff = $staff->where('is_hod', true)->first();
        $staffByRank = $staff->groupBy('rank')->map->count()->sortDesc();
        $staffAcceptingPg = $staff->where('accepting_pg', true)->count();

        // Programmes & Courses
        $programmes = Programme::with('category')->get();
        $programmeCount = $programmes->count();
        $activeProgrammes = $programmes->where('is_active', true)->count();
        $programmesByLevel = $programmes->groupBy('level')->map->count()->sortDesc();
        $categoryCount = ProgrammeCategory::count();
        $courses = Course::all();
        $courseCount = $courses->count();
        $coursesByLevel = $courses->groupBy('level')->map->count()->sortKeys();
        $electiveCount = $courses->where('is_elective', true)->count();
        $totalCredits = $courses->sum('credit_units');

        // News
        $newsAll = News::all();
        $newsCount = $newsAll->count();
        $newsByCategory = $newsAll->groupBy('category')->map->count()->sortDesc();
        $featuredNews = $newsAll->where('is_featured', true)->count();
        $recentNews = News::latest('published_at')->take(5)->get();
        $reactionCount = Reaction::count();
        $reactionsByType = Reaction::selectRaw('type, count(*) as cnt')->groupBy('type')->pluck('cnt', 'type')->sortDesc();

        // Events
        $eventAll = Event::all();
        $eventCount = $eventAll->count();
        $upcomingEvents = Event::where('date', '>=', now())->orderBy('date')->take(5)->get();
        $pastEvents = Event::where('date', '<', now())->count();
        $featuredEvents = $eventAll->where('is_featured', true)->count();

        // Announcements
        $announcementAll = Announcement::all();
        $announcementCount = $announcementAll->count();
        $activeAnnouncements = $announcementAll->filter(fn($a) => !$a->expires_at || Carbon::parse($a->expires_at)->isFuture())->count();
        $urgentAnnouncements = $announcementAll->where('priority', 'urgent')->count();

        // Gallery
        $albumCount = GalleryAlbum::count();
        $photoCount = GalleryImage::count();
        $albumsWithCounts = GalleryAlbum::withCount('images')->orderByDesc('date')->get();

        // Publications
        $publications = Publication::with('staff')->get();
        $publicationCount = $publications->count();
        $pubsByType = $publications->groupBy('type')->map->count()->sortDesc();
        $pubsByYear = $publications->groupBy('year')->map->count()->sortKeysDesc();

        // Leadership
        $pastHodCount = PastHod::count();
        $nacosPresidentCount = NacosPresident::count();
        $pastHods = PastHod::orderByDesc('tenure_end')->get();
        $nacosPresidents = NacosPresident::orderByDesc('tenure_end')->get();

        // Website/System
        $pageCount = Page::count();
        $activePages = Page::where('is_active', true)->count();
        $carouselCount = CarouselSlide::count();
        $activeCarousel = CarouselSlide::where('is_active', true)->count();
        $externalSystemCount = ExternalSystem::count();
        $socialLinkCount = SocialLink::count();
        $userCount = User::count();

        // Monthly trends (news, events, publications created in last 12 months)
        $monthlyNews = [];
        $monthlyEvents = [];
        $monthlyPublications = [];
        $monthlyLabels = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $label = $month->format('M Y');
            $shortLabel = $month->format('M');
            $monthlyLabels[] = $shortLabel;
            $monthlyNews[$label] = News::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyEvents[$label] = Event::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyPublications[$label] = Publication::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
        }

        // ─── Growth / Comparison (this month vs last month) ───
        $thisMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();

        $newsThisMonth = News::where('created_at', '>=', $thisMonth)->count();
        $newsLastMonth = News::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $newsGrowth = $newsLastMonth > 0 ? round((($newsThisMonth - $newsLastMonth) / $newsLastMonth) * 100) : ($newsThisMonth > 0 ? 100 : 0);

        $eventsThisMonth = Event::where('created_at', '>=', $thisMonth)->count();
        $eventsLastMonth = Event::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $eventsGrowth = $eventsLastMonth > 0 ? round((($eventsThisMonth - $eventsLastMonth) / $eventsLastMonth) * 100) : ($eventsThisMonth > 0 ? 100 : 0);

        $pubsThisMonth = Publication::where('created_at', '>=', $thisMonth)->count();
        $pubsLastMonth = Publication::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $pubsGrowth = $pubsLastMonth > 0 ? round((($pubsThisMonth - $pubsLastMonth) / $pubsLastMonth) * 100) : ($pubsThisMonth > 0 ? 100 : 0);

        // ─── Content Health Score ───
        $healthChecks = [
            'has_active_staff'       => $activeStaff > 0,
            'has_hod'                => $hodStaff !== null,
            'has_programmes'         => $activeProgrammes > 0,
            'has_courses'            => $courseCount > 0,
            'has_recent_news'        => News::where('created_at', '>=', now()->subMonths(3))->exists(),
            'has_upcoming_events'    => $upcomingEvents->count() > 0,
            'has_active_announcements' => $activeAnnouncements > 0,
            'has_gallery'            => $photoCount > 0,
            'has_publications'       => $publicationCount > 0,
            'has_carousel'           => $activeCarousel > 0,
            'has_social_links'       => $socialLinkCount > 0,
            'has_pages'              => $activePages > 0,
        ];
        $healthScore = round((collect($healthChecks)->filter()->count() / count($healthChecks)) * 100);

        // ─── Recent Activity Timeline ───
        $recentActivity = collect();

        // Recent news
        News::latest()->take(5)->get()->each(function ($item) use (&$recentActivity) {
            $recentActivity->push([
                'type' => 'news',
                'icon' => 'fa-newspaper',
                'color' => '#d97706',
                'title' => $item->title,
                'action' => 'News article published',
                'date' => $item->created_at,
                'url' => route('admin.news.edit', $item),
            ]);
        });

        // Recent events
        Event::latest()->take(5)->get()->each(function ($item) use (&$recentActivity) {
            $recentActivity->push([
                'type' => 'event',
                'icon' => 'fa-calendar-days',
                'color' => '#db2777',
                'title' => $item->title,
                'action' => 'Event created',
                'date' => $item->created_at,
                'url' => route('admin.events.edit', $item),
            ]);
        });

        // Recent announcements
        Announcement::latest()->take(3)->get()->each(function ($item) use (&$recentActivity) {
            $recentActivity->push([
                'type' => 'announcement',
                'icon' => 'fa-bullhorn',
                'color' => '#ea580c',
                'title' => $item->title,
                'action' => 'Announcement posted',
                'date' => $item->created_at,
                'url' => route('admin.announcements.edit', $item),
            ]);
        });

        // Recent staff
        Staff::latest()->take(3)->get()->each(function ($item) use (&$recentActivity) {
            $recentActivity->push([
                'type' => 'staff',
                'icon' => 'fa-user-tie',
                'color' => '#059669',
                'title' => $item->name,
                'action' => 'Staff member added',
                'date' => $item->created_at,
                'url' => route('admin.staff.edit', $item),
            ]);
        });

        $recentActivity = $recentActivity->sortByDesc('date')->take(10)->values();

        // ─── Top Publishing Staff ───
        $topPublishers = Staff::withCount('publications')
            ->having('publications_count', '>', 0)
            ->orderByDesc('publications_count')
            ->take(5)
            ->get();

        // ─── Course distribution (core vs elective) ───
        $coreCount = $courseCount - $electiveCount;

        return compact(
            'staffCount', 'activeStaff', 'hodStaff', 'staffByRank', 'staffAcceptingPg', 'staff',
            'programmeCount', 'activeProgrammes', 'programmesByLevel', 'categoryCount', 'programmes',
            'courseCount', 'coursesByLevel', 'electiveCount', 'totalCredits', 'courses', 'coreCount',
            'newsCount', 'newsByCategory', 'featuredNews', 'recentNews', 'reactionCount', 'reactionsByType',
            'eventCount', 'upcomingEvents', 'pastEvents', 'featuredEvents', 'eventAll',
            'announcementCount', 'activeAnnouncements', 'urgentAnnouncements', 'announcementAll',
            'albumCount', 'photoCount', 'albumsWithCounts',
            'publicationCount', 'pubsByType', 'pubsByYear', 'publications',
            'pastHodCount', 'nacosPresidentCount', 'pastHods', 'nacosPresidents',
            'pageCount', 'activePages', 'carouselCount', 'activeCarousel',
            'externalSystemCount', 'socialLinkCount', 'userCount',
            'monthlyNews', 'monthlyEvents', 'monthlyPublications', 'monthlyLabels',
            'newsThisMonth', 'newsLastMonth', 'newsGrowth',
            'eventsThisMonth', 'eventsLastMonth', 'eventsGrowth',
            'pubsThisMonth', 'pubsLastMonth', 'pubsGrowth',
            'healthScore', 'healthChecks',
            'recentActivity', 'topPublishers'
        );
    }

    // ─── Report Sections ────────────────────────────────────────

    private function reportStaff(array $s): array
    {
        $lines = [];
        $lines[] = 'STAFF DIRECTORY';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Staff:         {$s['staffCount']}";
        $lines[] = "  Active Staff:        {$s['activeStaff']}";
        $lines[] = "  Accepting PG:        {$s['staffAcceptingPg']}";
        $lines[] = "  Current HOD:         " . ($s['hodStaff'] ? $s['hodStaff']->name : 'Not assigned');
        $lines[] = '';
        $lines[] = '  Staff by Rank:';
        foreach ($s['staffByRank'] as $rank => $count) {
            $lines[] = "    " . str_pad(($rank ?: 'Unspecified'), 25) . $count;
        }
        $lines[] = '';
        $lines[] = '  Full Staff List:';
        $lines[] = '  ' . str_pad('Name', 35) . str_pad('Rank', 25) . str_pad('Email', 30) . 'Status';
        $lines[] = '  ' . str_repeat('-', 95);
        foreach ($s['staff'] as $st) {
            $lines[] = '  ' . str_pad(Str::limit($st->name, 33), 35)
                . str_pad($st->rank ?? '-', 25)
                . str_pad($st->email, 30)
                . ($st->is_active ? 'Active' : 'Inactive');
        }
        return $lines;
    }

    private function reportProgrammes(array $s): array
    {
        $lines = [];
        $lines[] = 'PROGRAMMES';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Programmes:    {$s['programmeCount']}";
        $lines[] = "  Active Programmes:   {$s['activeProgrammes']}";
        $lines[] = "  Categories:          {$s['categoryCount']}";
        $lines[] = '';
        $lines[] = '  Programmes by Level:';
        foreach ($s['programmesByLevel'] as $level => $count) {
            $lines[] = "    " . str_pad($level, 15) . $count;
        }
        $lines[] = '';
        $lines[] = '  Programme List:';
        $lines[] = '  ' . str_pad('Name', 45) . str_pad('Level', 10) . str_pad('Duration', 15) . 'Status';
        $lines[] = '  ' . str_repeat('-', 80);
        foreach ($s['programmes'] as $p) {
            $lines[] = '  ' . str_pad(Str::limit($p->name, 43), 45)
                . str_pad($p->level ?? '-', 10)
                . str_pad($p->duration ?? '-', 15)
                . ($p->is_active ? 'Active' : 'Inactive');
        }
        return $lines;
    }

    private function reportCourses(array $s): array
    {
        $lines = [];
        $lines[] = 'COURSES';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Courses:       {$s['courseCount']}";
        $lines[] = "  Elective Courses:    {$s['electiveCount']}";
        $lines[] = "  Total Credit Units:  {$s['totalCredits']}";
        $lines[] = '';
        $lines[] = '  Courses by Level:';
        foreach ($s['coursesByLevel'] as $level => $count) {
            $lines[] = "    Level " . str_pad($level, 10) . $count . " courses";
        }
        $lines[] = '';
        $lines[] = '  Course List:';
        $lines[] = '  ' . str_pad('Code', 14) . str_pad('Title', 40) . str_pad('Level', 8) . str_pad('CU', 6) . str_pad('Sem', 6) . 'Type';
        $lines[] = '  ' . str_repeat('-', 80);
        foreach ($s['courses'] as $c) {
            $lines[] = '  ' . str_pad($c->code, 14)
                . str_pad(Str::limit($c->title, 38), 40)
                . str_pad($c->level, 8)
                . str_pad($c->credit_units, 6)
                . str_pad($c->semester, 6)
                . ($c->is_elective ? 'Elective' : 'Core');
        }
        return $lines;
    }

    private function reportNews(array $s): array
    {
        $lines = [];
        $lines[] = 'NEWS & BLOG';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Articles:      {$s['newsCount']}";
        $lines[] = "  Featured Articles:   {$s['featuredNews']}";
        $lines[] = "  Total Reactions:     {$s['reactionCount']}";
        $lines[] = '';
        $lines[] = '  Articles by Category:';
        foreach ($s['newsByCategory'] as $cat => $count) {
            $lines[] = "    " . str_pad($cat, 30) . $count;
        }
        if ($s['reactionsByType']->count()) {
            $lines[] = '';
            $lines[] = '  Reactions by Type:';
            foreach ($s['reactionsByType'] as $type => $count) {
                $lines[] = "    " . str_pad(ucfirst($type), 15) . $count;
            }
        }
        return $lines;
    }

    private function reportEvents(array $s): array
    {
        $lines = [];
        $lines[] = 'EVENTS';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Events:        {$s['eventCount']}";
        $lines[] = "  Upcoming Events:     " . $s['upcomingEvents']->count();
        $lines[] = "  Past Events:         {$s['pastEvents']}";
        $lines[] = "  Featured Events:     {$s['featuredEvents']}";
        if ($s['upcomingEvents']->count()) {
            $lines[] = '';
            $lines[] = '  Upcoming Events:';
            foreach ($s['upcomingEvents'] as $e) {
                $lines[] = "    " . Carbon::parse($e->date)->format('M j, Y') . " — {$e->title}" . ($e->venue ? " @ {$e->venue}" : '');
            }
        }
        return $lines;
    }

    private function reportAnnouncements(array $s): array
    {
        $lines = [];
        $lines[] = 'ANNOUNCEMENTS';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total:               {$s['announcementCount']}";
        $lines[] = "  Active:              {$s['activeAnnouncements']}";
        $lines[] = "  Urgent:              {$s['urgentAnnouncements']}";
        if ($s['announcementAll']->count()) {
            $lines[] = '';
            $lines[] = '  Recent Announcements:';
            foreach ($s['announcementAll']->take(10) as $a) {
                $lines[] = "    [{$a->priority}] {$a->title}";
            }
        }
        return $lines;
    }

    private function reportGallery(array $s): array
    {
        $lines = [];
        $lines[] = 'PHOTO GALLERY';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Albums:        {$s['albumCount']}";
        $lines[] = "  Total Photos:        {$s['photoCount']}";
        if ($s['albumsWithCounts']->count()) {
            $lines[] = '';
            $lines[] = '  Albums:';
            $lines[] = '  ' . str_pad('Album Title', 40) . str_pad('Date', 15) . 'Photos';
            $lines[] = '  ' . str_repeat('-', 60);
            foreach ($s['albumsWithCounts'] as $a) {
                $lines[] = '  ' . str_pad(Str::limit($a->title, 38), 40)
                    . str_pad($a->date ? Carbon::parse($a->date)->format('M j, Y') : '-', 15)
                    . $a->images_count;
            }
        }
        return $lines;
    }

    private function reportPublications(array $s): array
    {
        $lines = [];
        $lines[] = 'PUBLICATIONS & RESEARCH';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Total Publications:  {$s['publicationCount']}";
        $lines[] = '';
        $lines[] = '  By Type:';
        foreach ($s['pubsByType'] as $type => $count) {
            $lines[] = "    " . str_pad(ucfirst($type ?: 'unspecified'), 20) . $count;
        }
        if ($s['pubsByYear']->count()) {
            $lines[] = '';
            $lines[] = '  By Year:';
            foreach ($s['pubsByYear']->take(10) as $year => $count) {
                $lines[] = "    " . str_pad($year ?: 'Unknown', 10) . $count;
            }
        }
        return $lines;
    }

    private function reportLeadership(array $s): array
    {
        $lines = [];
        $lines[] = 'LEADERSHIP HISTORY';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  Past HODs:           {$s['pastHodCount']}";
        $lines[] = "  NACOS Presidents:    {$s['nacosPresidentCount']}";
        if ($s['pastHods']->count()) {
            $lines[] = '';
            $lines[] = '  HOD History:';
            foreach ($s['pastHods'] as $h) {
                $lines[] = "    " . str_pad($h->name, 30) . ($h->tenure_start ?? '?') . ' — ' . ($h->tenure_end ?? 'Present');
            }
        }
        if ($s['nacosPresidents']->count()) {
            $lines[] = '';
            $lines[] = '  NACOS Presidents:';
            foreach ($s['nacosPresidents'] as $p) {
                $lines[] = "    " . str_pad($p->name, 30) . ($p->tenure_start ?? '?') . ' — ' . ($p->tenure_end ?? 'Present');
            }
        }
        return $lines;
    }

    private function reportWebsite(array $s): array
    {
        $lines = [];
        $lines[] = 'WEBSITE & SYSTEM';
        $lines[] = str_repeat('-', 40);
        $lines[] = "  CMS Pages:           {$s['pageCount']} ({$s['activePages']} active)";
        $lines[] = "  Carousel Slides:     {$s['carouselCount']} ({$s['activeCarousel']} active)";
        $lines[] = "  External Systems:    {$s['externalSystemCount']}";
        $lines[] = "  Social Links:        {$s['socialLinkCount']}";
        $lines[] = "  Admin Users:         {$s['userCount']}";
        return $lines;
    }
}
