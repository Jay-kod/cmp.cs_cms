<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DepartmentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    /**
     * Display the super admin dashboard.
     */
    public function index()
    {
        // Gather system-level metrics
        $stats = [
            'totalAdmins' => User::where('is_admin', true)->count(),
            'totalSuperAdmins' => User::where('role', User::ROLE_SUPER_ADMIN)->count(),
            'totalEditors' => User::where('role', User::ROLE_EDITOR)->count(),
            'totalExternalSystems' => \App\Models\ExternalSystem::count(),
            'lastBackupDate' => $this->getLastBackupDate(),
            'settingsConfigured' => DepartmentSetting::count() > 0,
        ];

        // Fetch recent admin actions or users (example)
        $recentUsers = User::where('is_admin', true)->latest()->take(5)->get();

        return view('super-admin.dashboard', compact('stats', 'recentUsers'));
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
