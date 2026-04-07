@extends('layouts.admin')

@section('title', 'System Logs')
@section('header', 'System Event Logs')

@section('content')
<style>
    .analytics-kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
    .kpi-card { background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border-top: 4px solid var(--color-primary); display: flex; align-items: center; justify-content: space-between; }
    .kpi-card-content h3 { margin: 0; font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .kpi-card-content div { font-size: 2rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem; }
    .kpi-card-icon { width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
    
    .chart-container { background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 2rem; height: 320px; }
    
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .modern-table th { background: #f8fafc; padding: 1rem; text-align: left; font-size: 0.85rem; font-weight: 600; color: #64748b; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; }
    .modern-table td { padding: 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; color: #334155; }
    .modern-table tr:last-child td { border-bottom: none; }
    .modern-table tr:hover td { background-color: #f8fafc; }
    
    .badge { display: inline-flex; align-items: center; px; padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .badge-blue { background: #eff6ff; color: #2563eb; }
    .badge-green { background: #ecfdf5; color: #059669; }
    .badge-orange { background: #fff7ed; color: #ea580c; }
    .badge-red { background: #fef2f2; color: #dc2626; }
    .badge-gray { background: #f1f5f9; color: #475569; }

    .search-bar { background: white; padding: 1.25rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
    .search-bar input, .search-bar select { padding: 0.6rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; flex: 1; min-width: 200px; font-family: inherit; }
    .search-bar button { background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
    .search-bar button:hover { background: #1e40af; }
    
    .agent-icon { display: inline-flex; justify-content: center; align-items: center; width: 24px; height: 24px; background: #e2e8f0; border-radius: 4px; color: #475569; font-size: 0.75rem; margin-right: 0.4rem; vertical-align: middle; }
    
    .trend-up { color: #059669; font-weight: 600; font-size: 0.75rem; }
    .trend-down { color: #dc2626; font-weight: 600; font-size: 0.75rem; }
</style>

<!-- Top KPI Row -->
<div class="analytics-kpi-grid">
    <div data-aos="fade-up" class="kpi-card" style="background: linear-gradient(135deg, white 0%, #f8fafc 100%);">
        <div data-aos="fade-up" class="kpi-card-content">
            <h3>Total Audit Logs</h3>
            <div>{{ number_format($totalLogs) }}</div>
            <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; display: block;"><i class="fa-solid fa-server" style="color: #cbd5e1;"></i> Lifetime Platform Records</span>
        </div>
        <div data-aos="fade-up" class="kpi-card-icon" style="background: #eff6ff; color: #3b82f6; box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);">
            <i class="fa-solid fa-database"></i>
        </div>
    </div>
    
    <div data-aos="fade-up" class="kpi-card" style="border-top-color: #10b981; background: linear-gradient(135deg, white 0%, #f0fdf4 100%);">
        <div data-aos="fade-up" class="kpi-card-content">
            <h3>24h Activity</h3>
            <div>{{ number_format($todayLogs) }}</div>
            <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                <span class="{{ $activityGrowth >= 0 ? 'trend-up' : 'trend-down' }}">
                    <i class="fa-solid fa-arrow-trend-{{ $activityGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($activityGrowth) }}%
                </span>
                from yesterday
            </span>
        </div>
        <div data-aos="fade-up" class="kpi-card-icon" style="background: #ecfdf5; color: #10b981; box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);">
            <i class="fa-solid fa-bolt"></i>
        </div>
    </div>

    <div data-aos="fade-up" class="kpi-card" style="border-top-color: #f59e0b; background: linear-gradient(135deg, white 0%, #fffbeb 100%);">
        <div data-aos="fade-up" class="kpi-card-content">
            <h3>Active Users (7d)</h3>
            <div>{{ number_format($uniqueUsersThisWeek) }}</div>
            <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                <span class="{{ $userGrowth >= 0 ? 'trend-up' : 'trend-down' }}">
                    <i class="fa-solid fa-arrow-trend-{{ $userGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($userGrowth) }}%
                </span>
                from last week
            </span>
        </div>
        <div data-aos="fade-up" class="kpi-card-icon" style="background: #fffbeb; color: #f59e0b; box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);">
            <i class="fa-solid fa-users-viewfinder"></i>
        </div>
    </div>
</div>

<!-- Main Split: Chart + Data -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Trend Chart -->
    <div class="chart-container" style="margin-bottom: 0;">
        <div style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
            <span><i class="fa-solid fa-chart-area" style="color: #6366f1; margin-right: 0.4rem;"></i> Request Volume Pipeline (Last 7 Days)</span>
        </div>
        <div style="height: 240px; width: 100%;">
            <canvas id="logsChart"></canvas>
        </div>
    </div>
    
    <!-- Doughnut Breakdown -->
    <div class="chart-container" style="margin-bottom: 0; display: flex; flex-direction: column;">
        <div style="font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">
            <i class="fa-solid fa-chart-pie" style="color: #8b5cf6; margin-right: 0.4rem;"></i> Top Events Dist.
        </div>
        <div style="flex: 1; position: relative;">
            <canvas id="actionPieChart"></canvas>
        </div>
    </div>
</div>

<!-- Filters -->
<form action="{{ route('admin.system-logs.index') }}" method="GET" class="search-bar" style="background: #f8fafc; border: 1px solid #e2e8f0;">
    <div style="display: flex; gap: 0.5rem; flex: 2; align-items: center; background: white; border: 1px solid #cbd5e1; border-radius: 8px; padding-left: 1rem; box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);">
        <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8;"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by description, IP, User ID..." style="border: none; background: transparent; padding: 0.6rem; flex: 1; outline: none; font-size: 0.9rem;">
    </div>
    
    <select name="action" style="flex: 1; background-color: white; border-color: #cbd5e1; box-shadow: inset 0 1px 2px rgba(0,0,0,0.02); font-size: 0.9rem;">
        <option value="">All Event Action Types</option>
        @foreach($actionTypes as $type)
            <option value="{{ $type }}" {{ request('action') === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
        @endforeach
    </select>
    
    <button type="submit" style="background: #334155; box-shadow: 0 2px 4px rgba(51,65,85,0.2);"><i class="fa-solid fa-filter"></i> Apply Filters</button>
    @if(request()->hasAny(['q', 'action']))
        <a href="{{ route('admin.system-logs.index') }}" class="btn btn-secondary" style="padding: 0.6rem 1rem; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; color: #475569; border: 1px solid #e2e8f0; background: white; font-weight: 600;"><i class="fa-solid fa-xmark"></i> Clear</a>
    @endif
</form>

<!-- Logs Table -->
<div style="overflow-x: auto; padding-bottom: 2rem;">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 25%;">Timestamp</th>
                <th style="width: 15%;">Event Type</th>
                <th style="width: 20%;">User / Agent</th>
                <th style="width: 25%;">Description</th>
                <th style="width: 15%; text-align: right;">Network IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>
                    <div style="font-weight: 600; color: #0f172a;">{{ $log->created_at->format('M d, Y') }}</div>
                    <div style="font-size: 0.8rem; color: #64748b; font-family: monospace;">{{ $log->created_at->format('H:i:s.v') }}</div>
                </td>
                <td>
                    @php
                        $badgeClass = 'badge-gray';
                        if (str_contains(strtolower($log->action), 'login')) $badgeClass = 'badge-blue';
                        elseif (str_contains(strtolower($log->action), 'create')) $badgeClass = 'badge-green';
                        elseif (str_contains(strtolower($log->action), 'delete')) $badgeClass = 'badge-red';
                        elseif (str_contains(strtolower($log->action), 'update')) $badgeClass = 'badge-orange';
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ str_replace('_', ' ', $log->action) }}</span>
                </td>
                <td>
                    @if($log->user)
                        <div style="font-weight: 600; color: #3b82f6;"><i class="fa-solid fa-user-circle" style="margin-right: 0.3rem;"></i>{{ $log->user->name }}</div>
                    @else
                        <div style="font-weight: 600; color: #94a3b8;"><i class="fa-solid fa-robot" style="margin-right: 0.3rem;"></i>System / Guest</div>
                    @endif
                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.4rem; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $log->user_agent }}">
                        <span class="agent-icon">
                            @if(str_contains(strtolower($log->user_agent), 'mobile'))
                                <i class="fa-solid fa-mobile-screen"></i>
                            @elseif(str_contains(strtolower($log->user_agent), 'mac'))
                                <i class="fa-brands fa-apple"></i>
                            @elseif(str_contains(strtolower($log->user_agent), 'windows'))
                                <i class="fa-brands fa-windows"></i>
                            @elseif(str_contains(strtolower($log->user_agent), 'linux'))
                                <i class="fa-brands fa-linux"></i>
                            @else
                                <i class="fa-solid fa-globe"></i>
                            @endif
                        </span>
                        {{ $log->user_agent ?? 'Unknown Client' }}
                    </div>
                </td>
                <td>
                    <div style="color: #334155; font-size: 0.9rem; font-weight: 500;">{{ $log->description ?? 'No description provided' }}</div>
                    @if($log->entity_type && $log->entity_id)
                        <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 0.3rem; font-family: monospace; background: #f8fafc; padding: 0.15rem 0.4rem; border-radius: 4px; display: inline-block;">
                            <i class="fa-solid fa-link" style="margin-right:0.2rem;"></i>{{ class_basename($log->entity_type) }} #{{ $log->entity_id }}
                        </div>
                    @endif
                </td>
                <td style="text-align: right;">
                    <div style="font-family: monospace; font-size: 0.85rem; padding: 0.2rem 0.5rem; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 4px; color: #475569; display: inline-block;">
                        <i class="fa-solid fa-network-wired" style="color: #94a3b8; margin-right: 0.3rem;"></i>{{ $log->ip_address ?? '127.0.0.1' }}
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 3rem; color: #64748b;">
                    <i class="fa-solid fa-box-open" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                    No system logs found matching your criteria.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $logs->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Shared chart font
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b';

    // 1. Trend Line Chart
    const lineCtx = document.getElementById('logsChart');
    if(lineCtx) {
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'System Events',
                    data: @json($chartValues),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        cornerRadius: 8,
                        titleFont: { weight: '600' }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                    },
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#e2e8f0', drawBorder: false },
                        ticks: { stepSize: 5 }
                    }
                }
            }
        });
    }

    // 2. Action Categories Doughnut Chart
    const pieCtx = document.getElementById('actionPieChart');
    if(pieCtx) {
        const pColors = ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444', '#64748b'];
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: @json($doughnutLabels),
                datasets: [{
                    data: @json($doughnutValues),
                    backgroundColor: pColors,
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, font: { size: 11 } }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        cornerRadius: 8
                    }
                }
            }
        });
    }
});
</script>
@endsection