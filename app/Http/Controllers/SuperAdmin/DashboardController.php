<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DepartmentSetting;
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
use App\Models\ExternalSystem;
use App\Models\Partner;
use App\Models\Page;
use App\Models\MediaFile;
use App\Models\MediaDerivative;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    /**
     * Display the super admin dashboard.
     * Shows ALL content stats + system-level stats (everything the admin sees + more).
     */
    public function index()
    {
        // ── Content stats (everything the normal admin sees) ──
        $contentStats = [
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
            'partnersCount' => Partner::count(),
            'pagesCount' => Page::count(),
        ];

        // ── System stats (super admin exclusive) ──
        $systemStats = [
            'totalUsers' => User::count(),
            'totalAdmins' => User::where('role', User::ROLE_ADMIN)->count(),
            'totalSuperAdmins' => User::where('role', User::ROLE_SUPER_ADMIN)->count(),
            'totalExternalSystems' => ExternalSystem::count(),
            'settingsCount' => DepartmentSetting::count(),
            'lastBackupDate' => $this->getLastBackupDate(),
        ];

        // ── Recent data for panels ──
        $recentUsers = User::latest()->take(5)->get();
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

        return view('super-admin.dashboard', compact(
            'contentStats',
            'systemStats',
            'recentUsers',
            'recentNews',
            'upcomingEvents',
            'mediaStatusCounts',
            'recentMedia',
            'mediaLastConvertedAt',
            'mediaLastFailedAt'
        ));
    }

    /**
     * Helper to get the date of the most recent database backup.
     */
    private function getLastBackupDate()
    {
        $backupPath = storage_path('app/backups');
        if (!File::exists($backupPath)) {
            return null;
        }

        $files = File::files($backupPath);
        if (empty($files)) {
            return null;
        }

        // Sort files by modified time descending
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return \Carbon\Carbon::createFromTimestamp(filemtime($files[0]))->diffForHumans();
    }
}
