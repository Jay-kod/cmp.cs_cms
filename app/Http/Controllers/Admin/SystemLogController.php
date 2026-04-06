<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SystemLogController extends Controller
{
    public function index(Request $request)
    {
        // Calculate dynamic analytics data like Google Analytics
        $totalLogs = SystemLog::count();
        
        $todayLogs = SystemLog::whereDate('created_at', Carbon::today())->count();
        $yesterdayLogs = SystemLog::whereDate('created_at', Carbon::yesterday())->count();
        $activityGrowth = $yesterdayLogs > 0 ? round((($todayLogs - $yesterdayLogs) / $yesterdayLogs) * 100, 1) : 100;
        
        $uniqueUsersThisWeek = SystemLog::where('created_at', '>=', Carbon::now()->subDays(7))
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        $uniqueUsersLastWeek = SystemLog::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        $userGrowth = $uniqueUsersLastWeek > 0 ? round((($uniqueUsersThisWeek - $uniqueUsersLastWeek) / $uniqueUsersLastWeek) * 100, 1) : 100;

        // Chart data: Logs per day for the last 7 days
        $trendData = SystemLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');
            
        // Fill in missing days
        $chartLabels = [];
        $chartValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::now()->subDays($i)->format('M d');
            $chartValues[] = $trendData->get($date, 0);
        }

        // Action distribution for Doughnut chart
        $actionDist = SystemLog::selectRaw('action, COUNT(*) as count')
            ->groupBy('action')
            ->orderByDesc('count')
            ->take(5)
            ->get();
            
        $doughnutLabels = $actionDist->pluck('action')->map(fn($a) => ucfirst(str_replace('_', ' ', $a)));
        $doughnutValues = $actionDist->pluck('count');

        // Search and filter query
        $query = SystemLog::with('user')->latest();

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('action', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('ip_address', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        $logs = $query->paginate(20)->withQueryString();
        
        // Distinct actions for the dropdown
        $actionTypes = SystemLog::select('action')->distinct()->pluck('action');

        return view('admin.system-logs.index', compact(
            'logs', 
            'totalLogs', 
            'todayLogs', 
            'activityGrowth',
            'uniqueUsersThisWeek', 
            'userGrowth',
            'chartLabels', 
            'chartValues',
            'doughnutLabels',
            'doughnutValues',
            'actionTypes'
        ));
    }
}
