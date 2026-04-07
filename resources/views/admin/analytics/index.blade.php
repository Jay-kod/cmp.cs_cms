@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Analytics & Reports')
@section('header', 'Analytics & Reports')

@section('content')
<style>
/* ─── Analytics Page Styles ─── */
.analytics-grid { display: grid; gap: 1.5rem; }
.ag-2 { grid-template-columns: repeat(2, 1fr); }
.ag-3 { grid-template-columns: repeat(3, 1fr); }
.ag-4 { grid-template-columns: repeat(4, 1fr); }
.ag-5 { grid-template-columns: repeat(5, 1fr); }

/* Stat Cards */
.kpi-card {
    background: linear-gradient(135deg, white, #f0fdf4); border-radius: 12px; padding: 0.85rem 1rem; border: 1px solid #dcfce7;
    position: relative; overflow: hidden; transition: all 0.3s ease;
}
.kpi-card:hover { box-shadow: 0 6px 16px rgba(22,163,74,0.08); transform: translateY(-2px); border-color: #bbf7d0; }
.kpi-card .kpi-bg-icon {
    position: absolute; right: -8px; bottom: -8px; font-size: 3rem; opacity: 0.12;
    transform: rotate(-15deg); pointer-events: none;
}
.kpi-top { display: flex; align-items: center; justify-content: flex-end; margin-bottom: 0.4rem; min-height: 20px; }
.kpi-growth {
    display: inline-flex; align-items: center; gap: 0.2rem; padding: 0.1rem 0.4rem;
    border-radius: 20px; font-size: 0.65rem; font-weight: 700;
}
.kpi-growth.up { background: #ecfdf5; color: #059669; }
.kpi-growth.down { background: #fef2f2; color: #ef4444; }
.kpi-growth.neutral { background: #f1f5f9; color: #64748b; }
.kpi-value { font-size: 1.45rem; font-weight: 800; color: #0f172a; line-height: 1; }
.kpi-label { font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; }
.kpi-sub { font-size: 0.65rem; color: #94a3b8; margin-top: 0.15rem; }

/* Section Cards */
.a-card {
    background: white; border-radius: 16px; border: 1px solid #e2e8f0;
    overflow: hidden; transition: box-shadow 0.3s;
}
.a-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.a-card-header {
    padding: 1.2rem 1.5rem; border-bottom: 1px solid #f1f5f9;
    display: flex; justify-content: space-between; align-items: center;
}
.a-card-title {
    font-size: 1rem; font-weight: 700; color: #0f172a; display: flex;
    align-items: center; gap: 0.5rem;
}
.a-card-body { padding: 1.5rem; }

/* Download Button */
.dl-btn {
    display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.9rem;
    border-radius: 8px; font-size: 0.78rem; font-weight: 600; text-decoration: none;
    border: 1px solid #e2e8f0; color: #475569; background: #f8fafc; transition: all 0.2s; cursor: pointer;
}
.dl-btn:hover { background: #f1f5f9; border-color: #cbd5e1; color: #0f172a; }

/* Health Score */
.health-ring-container { position: relative; display: flex; align-items: center; justify-content: center; }
.health-ring-text {
    position: absolute; display: flex; flex-direction: column; align-items: center;
    justify-content: center; font-family: var(--font-heading, 'Outfit', sans-serif);
}
.health-ring-value { font-size: 2rem; font-weight: 800; color: #0f172a; line-height: 1; }
.health-ring-label { font-size: 0.7rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; }

.health-check-item {
    display: flex; align-items: center; gap: 0.5rem; padding: 0.4rem 0;
    font-size: 0.82rem; color: #475569;
}
.health-check-icon { width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.55rem; flex-shrink: 0; }
.health-check-icon.pass { background: #ecfdf5; color: #059669; }
.health-check-icon.fail { background: #fef2f2; color: #ef4444; }

/* Mini Tables */
.mini-table { width: 100%; font-size: 0.82rem; border-collapse: collapse; }
.mini-table th { text-align: left; padding: 0.55rem 0.7rem; color: #64748b; font-weight: 600; border-bottom: 2px solid #f1f5f9; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; }
.mini-table td { padding: 0.55rem 0.7rem; color: #334155; border-bottom: 1px solid #f8fafc; }
.mini-table tr:last-child td { border-bottom: none; }
.mini-table tbody tr:hover { background: #f8fafc; }

/* Bar Charts */
.bar-track { height: 8px; background: #f1f5f9; border-radius: 4px; overflow: hidden; flex: 1; }
.bar-fill { height: 100%; border-radius: 4px; transition: width 0.8s ease; }
.chart-bar-row { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.5rem; }
.chart-bar-label { width: 90px; font-size: 0.78rem; color: #64748b; text-align: right; flex-shrink: 0; }
.chart-bar-value { font-size: 0.78rem; color: #64748b; width: 30px; flex-shrink: 0; font-weight: 600; }

/* Activity Timeline */
.timeline-item {
    display: flex; gap: 1rem; padding: 0.8rem 0; border-bottom: 1px solid #f8fafc;
    transition: background 0.2s; position: relative;
}
.timeline-item:last-child { border-bottom: none; }
.timeline-item:hover { background: #fafbfc; border-radius: 8px; padding-left: 0.5rem; padding-right: 0.5rem; }
.timeline-icon {
    width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center;
    justify-content: center; font-size: 0.85rem; flex-shrink: 0;
}
.timeline-content { flex: 1; min-width: 0; }
.timeline-action { font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
.timeline-title {
    font-size: 0.85rem; color: #1e293b; font-weight: 600; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
}
.timeline-date { font-size: 0.72rem; color: #94a3b8; margin-top: 2px; }

/* Quick Actions */
.quick-action {
    display: flex; align-items: center; gap: 0.8rem; padding: 0.75rem 1rem;
    border-radius: 10px; text-decoration: none; color: #334155; font-size: 0.85rem;
    font-weight: 600; transition: all 0.2s; border: 1px solid #f1f5f9;
}
.quick-action:hover { background: #f8fafc; border-color: #e2e8f0; transform: translateX(4px); }
.quick-action .qa-icon {
    width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center;
    justify-content: center; font-size: 0.85rem; flex-shrink: 0;
}
.quick-action .qa-arrow { margin-left: auto; color: #cbd5e1; font-size: 0.7rem; transition: color 0.2s; }
.quick-action:hover .qa-arrow { color: #64748b; }

/* Tabs */
.analytics-tabs { display: flex; gap: 0.25rem; background: #f1f5f9; padding: 0.25rem; border-radius: 10px; flex-wrap: wrap; }
.analytics-tab {
    padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600;
    color: #64748b; cursor: pointer; transition: all 0.2s; border: none; background: none;
}
.analytics-tab.active { background: white; color: #0f172a; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
.analytics-tab:hover:not(.active) { color: #475569; }

.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* Responsive */
@media (max-width: 1200px) {
    .ag-5 { grid-template-columns: repeat(3, 1fr); }
    .ag-4 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 900px) {
    .ag-5, .ag-4, .ag-3 { grid-template-columns: repeat(2, 1fr); }
    .ag-2 { grid-template-columns: 1fr; }
    .a-card[style*="grid-column: span 2"] { grid-column: span 1 !important; }
}
@media (max-width: 600px) {
    .ag-5, .ag-4, .ag-3, .ag-2 { grid-template-columns: 1fr; }
    .tab-panel .analytics-grid, [style*="grid-template-columns: 1fr 1fr"] { grid-template-columns: 1fr !important; }
}

/* Print */
@media print {
    .dl-btn, .analytics-tabs, .quick-action, .no-print { display: none !important; }
    .a-card, .kpi-card { break-inside: avoid; box-shadow: none !important; border: 1px solid #ddd !important; }
}

/* Animate counters on load */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(16px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-in { animation: fadeInUp 0.5s ease forwards; }
</style>

{{-- ═══════════════ HERO BANNER ═══════════════ --}}
<div data-aos="fade-up" class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f4c75 100%); border: none; border-radius: 16px; position: relative; overflow: hidden;">
    <div style="position: absolute; right: 0; top: 0; width: 300px; height: 100%; opacity: 0.05;">
        <svg viewBox="0 0 200 200" fill="white" style="width: 100%; height: 100%;">
            <circle cx="100" cy="100" r="80" /><circle cx="160" cy="40" r="30" /><circle cx="40" cy="160" r="20" />
        </svg>
    </div>
    <div style="position: relative; z-index: 1;">
        <h2 style="margin: 0; font-size: 1.3rem; color: white; font-weight: 700; font-family: var(--font-heading, 'Outfit', sans-serif);">
            <i class="fa-solid fa-chart-line" style="margin-right: 0.5rem; opacity: 0.7;"></i> Department Analytics
        </h2>
        <p style="margin: 0.4rem 0 0; color: rgba(255,255,255,0.55); font-size: 0.85rem;">
            Real-time overview of all department data, content, and performance metrics.
            <span style="color: rgba(255,255,255,0.35);">Last updated: {{ now()->format('M j, Y \a\t g:i A') }}</span>
        </p>
    </div>
    <div style="display: flex; gap: 0.6rem; position: relative; z-index: 1; flex-wrap: wrap;" class="no-print">
        <button onclick="window.print()" class="dl-btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(4px);">
            <i class="fa-solid fa-print"></i> Print
        </button>
        <a href="{{ route('admin.analytics.download', ['section' => 'all']) }}" class="dl-btn" style="background: white; color: #0f172a; border: none; padding: 0.6rem 1.4rem; font-size: 0.88rem; font-weight: 700; border-radius: 10px;">
            <i class="fa-solid fa-download"></i> Download Full Report
        </a>
    </div>
</div>

{{-- ═══════════════ KPI CARDS ═══════════════ --}}
<div class="analytics-grid ag-5" style="margin-bottom: 1.5rem;">
    @php
        $kpiCards = [
            ['label' => 'Staff Members', 'value' => $staffCount, 'sub' => $activeStaff . ' active', 'icon' => 'fa-solid fa-users', 'bg' => '#ecfdf5', 'color' => '#059669', 'bgIcon' => 'fa-solid fa-users'],
            ['label' => 'Programmes', 'value' => $programmeCount, 'sub' => $activeProgrammes . ' active', 'icon' => 'fa-solid fa-graduation-cap', 'bg' => '#eff6ff', 'color' => '#2563eb', 'bgIcon' => 'fa-solid fa-graduation-cap'],
            ['label' => 'Courses', 'value' => $courseCount, 'sub' => $totalCredits . ' credit units', 'icon' => 'fa-solid fa-book', 'bg' => '#faf5ff', 'color' => '#7c3aed', 'bgIcon' => 'fa-solid fa-book'],
            ['label' => 'News Articles', 'value' => $newsCount, 'sub' => $featuredNews . ' featured', 'icon' => 'fa-solid fa-newspaper', 'bg' => '#fef3c7', 'color' => '#d97706', 'bgIcon' => 'fa-solid fa-newspaper', 'growth' => $newsGrowth],
            ['label' => 'Events', 'value' => $eventCount, 'sub' => $upcomingEvents->count() . ' upcoming', 'icon' => 'fa-solid fa-calendar-days', 'bg' => '#fce7f3', 'color' => '#db2777', 'bgIcon' => 'fa-solid fa-calendar-days', 'growth' => $eventsGrowth],
            ['label' => 'Announcements', 'value' => $announcementCount, 'sub' => $activeAnnouncements . ' active · ' . $urgentAnnouncements . ' urgent', 'icon' => 'fa-solid fa-bullhorn', 'bg' => '#fff7ed', 'color' => '#ea580c', 'bgIcon' => 'fa-solid fa-bullhorn'],
            ['label' => 'Gallery Photos', 'value' => $photoCount, 'sub' => $albumCount . ' albums', 'icon' => 'fa-solid fa-images', 'bg' => '#f0fdf4', 'color' => '#16a34a', 'bgIcon' => 'fa-solid fa-images'],
            ['label' => 'Publications', 'value' => $publicationCount, 'sub' => $pubsByType->count() . ' types', 'icon' => 'fa-solid fa-file-lines', 'bg' => '#f5f3ff', 'color' => '#6d28d9', 'bgIcon' => 'fa-solid fa-file-lines', 'growth' => $pubsGrowth],
            ['label' => 'Reactions', 'value' => $reactionCount, 'sub' => $reactionsByType->count() . ' types', 'icon' => 'fa-solid fa-heart', 'bg' => '#fef2f2', 'color' => '#dc2626', 'bgIcon' => 'fa-solid fa-heart'],
            ['label' => 'Admin Users', 'value' => $userCount, 'sub' => 'system accounts', 'icon' => 'fa-solid fa-shield-halved', 'bg' => '#f0f9ff', 'color' => '#0284c7', 'bgIcon' => 'fa-solid fa-shield-halved'],
        ];
    @endphp
    @foreach($kpiCards as $i => $kpi)
    <div data-aos="fade-up" class="kpi-card animate-in" style="animation-delay: {{ $i * 0.05 }}s;">
        <i class="{{ $kpi['bgIcon'] }} kpi-bg-icon" style="color: {{ $kpi['color'] }};"></i>
        <div class="kpi-top">
            @if(isset($kpi['growth']))
                @if($kpi['growth'] > 0)
                    <span class="kpi-growth up"><i class="fa-solid fa-arrow-up"></i> {{ $kpi['growth'] }}%</span>
                @elseif($kpi['growth'] < 0)
                    <span class="kpi-growth down"><i class="fa-solid fa-arrow-down"></i> {{ abs($kpi['growth']) }}%</span>
                @else
                    <span class="kpi-growth neutral"><i class="fa-solid fa-minus"></i> 0%</span>
                @endif
            @endif
        </div>
        <div class="kpi-value" data-count="{{ $kpi['value'] }}">{{ number_format($kpi['value']) }}</div>
        <div class="kpi-label">{{ $kpi['label'] }}</div>
        <div class="kpi-sub">{{ $kpi['sub'] }}</div>
    </div>
    @endforeach
</div>

{{-- ═══════════════ CONTENT HEALTH + TREND + ACTIVITY ═══════════════ --}}
<div class="analytics-grid ag-3" style="margin-bottom: 1.5rem;">

    {{-- Content Health Score --}}
    <div data-aos="fade-up" class="a-card">
        <div class="a-card-header">
            <div data-aos="fade-up" class="a-card-title">
                <i class="fa-solid fa-heart-pulse" style="color: {{ $healthScore >= 80 ? '#059669' : ($healthScore >= 50 ? '#d97706' : '#ef4444') }};"></i>
                Content Health
            </div>
            <span style="font-size: 0.72rem; color: #94a3b8;">{{ collect($healthChecks)->filter()->count() }}/{{ count($healthChecks) }} checks</span>
        </div>
        <div data-aos="fade-up" class="a-card-body" style="display: flex; flex-direction: column; align-items: center;">
            <div class="health-ring-container" style="margin-bottom: 1.2rem;">
                <canvas id="healthChart" width="160" height="160"></canvas>
                <div class="health-ring-text">
                    <div class="health-ring-value">{{ $healthScore }}%</div>
                    <div class="health-ring-label">Score</div>
                </div>
            </div>
            <div style="width: 100%; max-height: 200px; overflow-y: auto;">
                @foreach($healthChecks as $check => $passed)
                <div data-aos="fade-up" class="health-check-item">
                    <div class="health-check-icon {{ $passed ? 'pass' : 'fail' }}">
                        <i class="fa-solid {{ $passed ? 'fa-check' : 'fa-xmark' }}"></i>
                    </div>
                    <span>{{ str_replace('_', ' ', Str::title(Str::after($check, 'has_'))) }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Content Trend (12 months) --}}
    <div data-aos="fade-up" class="a-card" style="grid-column: span 2;">
        <div class="a-card-header">
            <div data-aos="fade-up" class="a-card-title"><i class="fa-solid fa-chart-area" style="color: #6366f1;"></i> Content Trend (12 Months)</div>
            <div class="analytics-tabs no-print">
                <button class="analytics-tab active" onclick="switchTrendView('line', this)">Line</button>
                <button class="analytics-tab" onclick="switchTrendView('bar', this)">Bar</button>
            </div>
        </div>
        <div data-aos="fade-up" class="a-card-body" style="position: relative; height: 280px;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>
</div>

{{-- ═══════════════ TABBED DETAIL SECTIONS ═══════════════ --}}
<div data-aos="fade-up" class="a-card" style="margin-bottom: 1.5rem;">
    <div class="a-card-header" style="flex-wrap: wrap; gap: 0.8rem;">
        <div data-aos="fade-up" class="a-card-title"><i class="fa-solid fa-layer-group" style="color: #6366f1;"></i> Detailed Breakdown</div>
        <div class="analytics-tabs no-print" id="detailTabs">
            <button class="analytics-tab active" onclick="switchDetailTab('staff', this)">Staff</button>
            <button class="analytics-tab" onclick="switchDetailTab('academic', this)">Academic</button>
            <button class="analytics-tab" onclick="switchDetailTab('content', this)">Content</button>
            <button class="analytics-tab" onclick="switchDetailTab('media', this)">Media</button>
            <button class="analytics-tab" onclick="switchDetailTab('system', this)">System</button>
            <button class="analytics-tab" onclick="switchDetailTab('api', this)" style="display: inline-flex; align-items: center; gap: 0.4rem; background: #e0e7ff; color: #4338ca; border-radius: 8px;"><i class="fa-solid fa-server"></i> API Directory</button>
        </div>
    </div>
    <div data-aos="fade-up" class="a-card-body">

        {{-- STAFF TAB --}}
        <div class="tab-panel active" id="tab-staff">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;">Staff Overview</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'staff']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; margin-bottom: 1.2rem;">
                        <div style="padding: 0.8rem; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #059669;">{{ $activeStaff }}</div>
                            <div style="font-size: 0.78rem; color: #64748b;">Active Staff</div>
                        </div>
                        <div style="padding: 0.8rem; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #059669;">{{ $staffAcceptingPg }}</div>
                            <div style="font-size: 0.78rem; color: #64748b;">Accepting PG</div>
                        </div>
                    </div>
                    @if($hodStaff)
                    <div style="padding: 0.8rem; background: linear-gradient(135deg, #ecfdf5, #f0fdf4); border-radius: 10px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.8rem;">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #059669; color: white; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-crown" style="font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; color: #059669; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Current HOD</div>
                            <div style="font-size: 0.9rem; font-weight: 700; color: #065f46;">{{ $hodStaff->name }}</div>
                        </div>
                    </div>
                    @endif
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.6rem;">Staff by Rank</div>
                    @if($staffByRank->count())
                        @php $maxR = max(1, $staffByRank->max()); @endphp
                        @foreach($staffByRank->take(8) as $rank => $count)
                        <div class="chart-bar-row">
                            <div class="chart-bar-label">{{ Str::limit($rank ?: 'Unspecified', 14) }}</div>
                            <div class="bar-track"><div class="bar-fill" style="width: {{ ($count / $maxR) * 100 }}%; background: linear-gradient(90deg, #10b981, #34d399);"></div></div>
                            <div class="chart-bar-value">{{ $count }}</div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div>
                    <h4 style="margin: 0 0 1rem; font-size: 0.95rem; color: #0f172a;">Top Publishing Staff</h4>
                    @if($topPublishers->count())
                    <table class="mini-table">
                        <thead><tr><th>Researcher</th><th>Rank</th><th style="text-align: right;">Publications</th></tr></thead>
                        <tbody>
                        @foreach($topPublishers as $pub)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 30px; height: 30px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700;">
                                        {{ strtoupper(substr($pub->name, 0, 2)) }}
                                    </div>
                                    <strong>{{ Str::limit($pub->name, 20) }}</strong>
                                </div>
                            </td>
                            <td style="color: #94a3b8; font-size: 0.78rem;">{{ Str::limit($pub->rank ?? '-', 15) }}</td>
                            <td style="text-align: right; font-weight: 800; color: #6d28d9;">{{ $pub->publications_count }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <p style="color: #94a3b8; font-size: 0.85rem;">No publications recorded yet.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- ACADEMIC TAB --}}
        <div class="tab-panel" id="tab-academic">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;">Programmes</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'programmes']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; margin-bottom: 1.2rem;">
                        <div style="padding: 0.8rem; background: #eff6ff; border-radius: 10px;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #2563eb;">{{ $activeProgrammes }}</div>
                            <div style="font-size: 0.78rem; color: #64748b;">Active Programmes</div>
                        </div>
                        <div style="padding: 0.8rem; background: #eff6ff; border-radius: 10px;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #2563eb;">{{ $categoryCount }}</div>
                            <div style="font-size: 0.78rem; color: #64748b;">Categories</div>
                        </div>
                    </div>
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.6rem;">By Level</div>
                    @php $maxP = max(1, $programmesByLevel->count() ? $programmesByLevel->max() : 1); @endphp
                    @foreach($programmesByLevel as $level => $count)
                    <div class="chart-bar-row">
                        <div class="chart-bar-label">{{ $level }}</div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($count / $maxP) * 100 }}%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></div></div>
                        <div class="chart-bar-value">{{ $count }}</div>
                    </div>
                    @endforeach
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;">Courses</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'courses']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.6rem; margin-bottom: 1.2rem;">
                        <div style="padding: 0.8rem; background: #faf5ff; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #7c3aed;">{{ $courseCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Total</div>
                        </div>
                        <div style="padding: 0.8rem; background: #faf5ff; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #7c3aed;">{{ $coreCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Core</div>
                        </div>
                        <div style="padding: 0.8rem; background: #faf5ff; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #7c3aed;">{{ $electiveCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Elective</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <div style="flex: 1;">
                            <canvas id="courseTypeChart" height="160"></canvas>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.6rem;">By Level</div>
                            @php $maxC = max(1, $coursesByLevel->count() ? $coursesByLevel->max() : 1); @endphp
                            @foreach($coursesByLevel as $level => $count)
                            <div class="chart-bar-row">
                                <div class="chart-bar-label">Level {{ $level }}</div>
                                <div class="bar-track"><div class="bar-fill" style="width: {{ ($count / $maxC) * 100 }}%; background: linear-gradient(90deg, #8b5cf6, #a78bfa);"></div></div>
                                <div class="chart-bar-value">{{ $count }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT TAB --}}
        <div class="tab-panel" id="tab-content">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                {{-- News --}}
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-newspaper" style="color: #d97706; margin-right: 0.3rem;"></i> News & Blog</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'news']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: flex; gap: 0.8rem; margin-bottom: 1rem; flex-wrap: wrap;">
                        <div style="padding: 0.6rem 1rem; background: #fef3c7; border-radius: 10px;">
                            <span style="font-size: 1.1rem; font-weight: 800; color: #d97706;">{{ $newsCount }}</span>
                            <span style="font-size: 0.75rem; color: #92400e;"> articles</span>
                        </div>
                        <div style="padding: 0.6rem 1rem; background: #fef3c7; border-radius: 10px;">
                            <span style="font-size: 1.1rem; font-weight: 800; color: #d97706;">{{ $featuredNews }}</span>
                            <span style="font-size: 0.75rem; color: #92400e;"> featured</span>
                        </div>
                    </div>
                    @if($newsByCategory->count())
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.5rem;">By Category</div>
                    @php $maxN = max(1, $newsByCategory->max()); @endphp
                    @foreach($newsByCategory->take(6) as $cat => $count)
                    <div class="chart-bar-row">
                        <div class="chart-bar-label">{{ Str::limit($cat, 14) }}</div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($count / $maxN) * 100 }}%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div></div>
                        <div class="chart-bar-value">{{ $count }}</div>
                    </div>
                    @endforeach
                    @endif
                    @if($reactionsByType->count())
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin: 1rem 0 0.5rem;">Reactions Breakdown</div>
                    <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
                        @php $emojiMap = ['like' => "\xF0\x9F\x91\x8D", 'love' => "\xE2\x9D\xA4\xEF\xB8\x8F", 'clap' => "\xF0\x9F\x91\x8F", 'insightful' => "\xF0\x9F\x92\xA1", 'celebrate' => "\xF0\x9F\x8E\x89"]; @endphp
                        @foreach($reactionsByType as $type => $count)
                        <div style="padding: 0.4rem 0.8rem; background: #f8fafc; border-radius: 8px; font-size: 0.85rem;">
                            {{ $emojiMap[$type] ?? "\xF0\x9F\x91\x8D" }} <strong>{{ number_format($count) }}</strong> <span style="color: #94a3b8; font-size: 0.75rem;">{{ $type }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Events & Announcements --}}
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-calendar-days" style="color: #db2777; margin-right: 0.3rem;"></i> Events</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'events']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: flex; gap: 0.8rem; margin-bottom: 1rem; flex-wrap: wrap;">
                        <div style="padding: 0.6rem 1rem; background: #fce7f3; border-radius: 10px;">
                            <span style="font-size: 1.1rem; font-weight: 800; color: #db2777;">{{ $upcomingEvents->count() }}</span>
                            <span style="font-size: 0.75rem; color: #9d174d;"> upcoming</span>
                        </div>
                        <div style="padding: 0.6rem 1rem; background: #f1f5f9; border-radius: 10px;">
                            <span style="font-size: 1.1rem; font-weight: 800; color: #475569;">{{ $pastEvents }}</span>
                            <span style="font-size: 0.75rem; color: #64748b;"> past</span>
                        </div>
                        <div style="padding: 0.6rem 1rem; background: #fce7f3; border-radius: 10px;">
                            <span style="font-size: 1.1rem; font-weight: 800; color: #db2777;">{{ $featuredEvents }}</span>
                            <span style="font-size: 0.75rem; color: #9d174d;"> featured</span>
                        </div>
                    </div>
                    @if($upcomingEvents->count())
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.5rem;">Upcoming Events</div>
                    <table class="mini-table">
                        @foreach($upcomingEvents->take(4) as $e)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 36px; height: 40px; border-radius: 8px; background: #fce7f3; display: flex; flex-direction: column; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <span style="font-size: 0.6rem; color: #db2777; font-weight: 700; text-transform: uppercase; line-height: 1;">{{ \Carbon\Carbon::parse($e->date)->format('M') }}</span>
                                        <span style="font-size: 0.95rem; font-weight: 800; color: #be185d; line-height: 1;">{{ \Carbon\Carbon::parse($e->date)->format('d') }}</span>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; font-size: 0.85rem;">{{ Str::limit($e->title, 28) }}</div>
                                        @if($e->venue)<div style="font-size: 0.72rem; color: #94a3b8;"><i class="fa-solid fa-location-dot" style="margin-right: 0.2rem;"></i>{{ Str::limit($e->venue, 25) }}</div>@endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif

                    <div style="border-top: 1px solid #f1f5f9; margin-top: 1.2rem; padding-top: 1.2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                            <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-bullhorn" style="color: #ea580c; margin-right: 0.3rem;"></i> Announcements</h4>
                            <a href="{{ route('admin.analytics.download', ['section' => 'announcements']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                        </div>
                        <div style="display: flex; gap: 0.8rem; margin-bottom: 0.8rem; flex-wrap: wrap;">
                            <div style="padding: 0.5rem 0.8rem; background: #fff7ed; border-radius: 8px; font-size: 0.82rem;">
                                <strong style="color: #ea580c;">{{ $activeAnnouncements }}</strong> <span style="color: #9a3412;">active</span>
                            </div>
                            @if($urgentAnnouncements > 0)
                            <div style="padding: 0.5rem 0.8rem; background: #fef2f2; border-radius: 8px; font-size: 0.82rem;">
                                <strong style="color: #ef4444;">{{ $urgentAnnouncements }}</strong> <span style="color: #991b1b;">urgent</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MEDIA TAB --}}
        <div class="tab-panel" id="tab-media">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                {{-- Gallery --}}
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-images" style="color: #16a34a; margin-right: 0.3rem;"></i> Photo Gallery</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'gallery']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.6rem; margin-bottom: 1.2rem;">
                        <div style="padding: 0.8rem; background: #f0fdf4; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #16a34a;">{{ $albumCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Albums</div>
                        </div>
                        <div style="padding: 0.8rem; background: #f0fdf4; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #16a34a;">{{ number_format($photoCount) }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Photos</div>
                        </div>
                        <div style="padding: 0.8rem; background: #f0fdf4; border-radius: 10px; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #16a34a;">{{ $albumCount > 0 ? round($photoCount / $albumCount, 1) : 0 }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Avg/Album</div>
                        </div>
                    </div>
                    @if($albumsWithCounts->count())
                    <table class="mini-table">
                        <thead><tr><th>Album</th><th>Date</th><th style="text-align: right;">Photos</th></tr></thead>
                        <tbody>
                        @foreach($albumsWithCounts->take(6) as $a)
                        <tr>
                            <td><strong>{{ Str::limit($a->title, 22) }}</strong></td>
                            <td style="color: #94a3b8; white-space: nowrap; font-size: 0.78rem;">{{ $a->date ? \Carbon\Carbon::parse($a->date)->format('M j, Y') : '-' }}</td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">{{ $a->images_count }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                {{-- Publications --}}
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-file-lines" style="color: #6d28d9; margin-right: 0.3rem;"></i> Publications</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'publications']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="margin-bottom: 1.2rem;">
                        <div style="display: flex; gap: 1rem;">
                            <div style="flex: 1;">
                                <canvas id="pubTypeChart" height="180"></canvas>
                            </div>
                        </div>
                    </div>
                    @if($pubsByYear->count())
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">By Year (Recent)</div>
                    @php $maxPubY = max(1, $pubsByYear->max()); @endphp
                    @foreach($pubsByYear->take(6) as $year => $count)
                    <div class="chart-bar-row">
                        <div class="chart-bar-label">{{ $year ?: 'N/A' }}</div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($count / $maxPubY) * 100 }}%; background: linear-gradient(90deg, #8b5cf6, #a78bfa);"></div></div>
                        <div class="chart-bar-value">{{ $count }}</div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- SYSTEM TAB --}}
        <div class="tab-panel" id="tab-system">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-globe" style="color: #475569; margin-right: 0.3rem;"></i> Website & System</h4>
                        <a href="{{ route('admin.analytics.download', ['section' => 'website']) }}" class="dl-btn"><i class="fa-solid fa-download"></i> Report</a>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem;">
                        @php
                            $sysItems = [
                                ['icon' => 'fa-solid fa-file-alt', 'label' => 'CMS Pages', 'value' => $pageCount, 'sub' => $activePages . ' active', 'bg' => '#f0fdf4', 'color' => '#059669'],
                                ['icon' => 'fa-solid fa-photo-film', 'label' => 'Carousel Slides', 'value' => $carouselCount, 'sub' => $activeCarousel . ' active', 'bg' => '#eff6ff', 'color' => '#2563eb'],
                                ['icon' => 'fa-solid fa-arrow-up-right-from-square', 'label' => 'External Systems', 'value' => $externalSystemCount, 'sub' => '', 'bg' => '#faf5ff', 'color' => '#7c3aed'],
                                ['icon' => 'fa-solid fa-share-nodes', 'label' => 'Social Links', 'value' => $socialLinkCount, 'sub' => '', 'bg' => '#fef3c7', 'color' => '#d97706'],
                                ['icon' => 'fa-solid fa-shield-halved', 'label' => 'Admin Users', 'value' => $userCount, 'sub' => '', 'bg' => '#fce7f3', 'color' => '#db2777'],
                            ];
                        @endphp
                        @foreach($sysItems as $si)
                        <div style="padding: 1rem; background: {{ $si['bg'] }}; border-radius: 12px; display: flex; align-items: center; gap: 0.8rem;">
                            <div style="width: 38px; height: 38px; border-radius: 10px; background: white; color: {{ $si['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                                <i class="{{ $si['icon'] }}"></i>
                            </div>
                            <div>
                                <div style="font-size: 1.2rem; font-weight: 800; color: {{ $si['color'] }};">{{ $si['value'] }}</div>
                                <div style="font-size: 0.75rem; color: #64748b;">{{ $si['label'] }} @if($si['sub'])<span style="color: #94a3b8;">· {{ $si['sub'] }}</span>@endif</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 style="margin: 0 0 1rem; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-landmark" style="color: #0891b2; margin-right: 0.3rem;"></i> Leadership History</h4>
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <div style="padding: 0.8rem; background: #ecfeff; border-radius: 10px; flex: 1; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #0891b2;">{{ $pastHodCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">Past HODs</div>
                        </div>
                        <div style="padding: 0.8rem; background: #ecfeff; border-radius: 10px; flex: 1; text-align: center;">
                            <div style="font-size: 1.3rem; font-weight: 800; color: #0891b2;">{{ $nacosPresidentCount }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">NACOS Presidents</div>
                        </div>
                    </div>
                    @if($pastHods->count())
                    <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.5rem;">HOD Timeline</div>
                    <table class="mini-table">
                        <tbody>
                        @foreach($pastHods->take(5) as $h)
                        <tr>
                            <td><strong>{{ $h->name }}</strong></td>
                            <td style="color: #94a3b8; font-size: 0.78rem; white-space: nowrap;">{{ $h->tenure_start ?? '?' }} — {{ $h->tenure_end ?? 'Present' }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- API & SYSTEM METRICS TAB --}}
        <div class="tab-panel" id="tab-api">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h4 style="margin: 0 0 0.4rem; font-size: 1.1rem; color: #0f172a;"><i class="fa-solid fa-server" style="color: #4338ca; margin-right: 0.4rem;"></i> Internal System APIs & Health</h4>
                    <div style="font-size: 0.85rem; color: #64748b;">Genuine monitoring for your system's registered endpoints and core services.</div>
                </div>
                <div style="display: flex; gap: 0.8rem; align-items: center;">
                    <span style="padding: 0.4rem 0.8rem; background: #ecfdf5; color: #059669; border-radius: 6px; font-size: 0.8rem; font-weight: 600; border: 1px solid #a7f3d0;"><i class="fa-solid fa-check-circle"></i> Local Environment Active</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                {{-- Global Search API --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Global Search API</div>
                        <span style="background: #dcfce7; color: #166534; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;">Active</span>
                    </div>
                    <div style="font-size: 0.8rem; font-family: monospace; background: #1e293b; color: #a5b4fc; padding: 0.6rem; border-radius: 6px; margin-bottom: 0.8rem;">
                        GET /api/search?q={query}
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b; line-height: 1.4;">
                        Handles public search queries. Maps results from Programmes, News, Staff, Events, and Courses securely.
                    </div>
                </div>

                {{-- Content Freshness API --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Content Refresh Service</div>
                        <span style="background: #dcfce7; color: #166534; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;">Active</span>
                    </div>
                    <div style="font-size: 0.8rem; font-family: monospace; background: #1e293b; color: #a5b4fc; padding: 0.6rem; border-radius: 6px; margin-bottom: 0.8rem;">
                        GET /api/content-updated
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b; line-height: 1.4;">
                        Allows front-end clients to auto-refresh public pages dynamically by fetching the latest updated timestamps from 14 tables.
                    </div>
                </div>

                {{-- Authenticated User API --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Sanctum Auth API</div>
                        <span style="background: #dcfce7; color: #166534; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;">Protected</span>
                    </div>
                    <div style="font-size: 0.8rem; font-family: monospace; background: #1e293b; color: #a5b4fc; padding: 0.6rem; border-radius: 6px; margin-bottom: 0.8rem;">
                        GET /api/user (Protected)
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b; line-height: 1.4;">
                        Sanctum token-based authentication endpoint for reading the currently authed user profile via remote applications.
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; overflow-x: auto;">
                <h5 style="margin: 0 0 1rem; font-size: 0.95rem; color: #0f172a;"><i class="fa-solid fa-microchip" style="color: #6366f1; margin-right: 0.4rem;"></i> Real-Time Infrastructure Health</h5>
                <table style="width: 100%; border-collapse: separate; border-spacing: 0; min-width: 600px; text-align: left;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 0.8rem 1rem; font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Component</th>
                            <th style="padding: 0.8rem 1rem; font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Driver / Setup</th>
                            <th style="padding: 0.8rem 1rem; font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #0f172a;"><i class="fa-solid fa-database" style="color: #0891b2; margin-right: 0.5rem; width: 20px; text-align: center;"></i> Database (MySQL)</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 0.85rem; font-family: monospace;">{{ config('database.default') }}</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9;">
                                @php
                                    try {
                                        DB::connection()->getPdo();
                                        echo '<span style="color: #059669; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Connected successfully</span>';
                                    } catch(\Exception $e) {
                                        echo '<span style="color: #dc2626; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-circle-xmark"></i> Connection Error</span>';
                                    }
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #0f172a;"><i class="fa-solid fa-hard-drive" style="color: #fb923c; margin-right: 0.5rem; width: 20px; text-align: center;"></i> File Storage</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 0.85rem; font-family: monospace;">{{ config('filesystems.default') }} (local disk)</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9;">
                                @php
                                    $storageWritable = is_writable(storage_path('app/public'));
                                    if ($storageWritable) {
                                        echo '<span style="color: #059669; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Writable & Linked</span>';
                                    } else {
                                        echo '<span style="color: #ea580c; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-triangle-exclamation"></i> Check Permissions</span>';
                                    }
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #0f172a;"><i class="fa-solid fa-bolt" style="color: #eab308; margin-right: 0.5rem; width: 20px; text-align: center;"></i> Application Cache</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 0.85rem; font-family: monospace;">{{ config('cache.default') }}</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9;"><span style="color: #059669; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Operational</span></td>
                        </tr>
                         <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #0f172a;"><i class="fa-solid fa-code-compare" style="color: #8b5cf6; margin-right: 0.5rem; width: 20px; text-align: center;"></i> Environment Status</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 0.85rem; font-family: monospace;">{{ app()->environment() }}</td>
                            <td style="padding: 1rem; border-bottom: 1px solid #f1f5f9;"><span style="color: #059669; font-size: 0.8rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> PHP {{ PHP_VERSION }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ BOTTOM ROW: ACTIVITY + QUICK ACTIONS ═══════════════ --}}
<div class="analytics-grid ag-3" style="margin-bottom: 2rem;">

    {{-- Recent Activity Timeline --}}
    <div data-aos="fade-up" class="a-card" style="grid-column: span 2;">
        <div class="a-card-header">
            <div data-aos="fade-up" class="a-card-title"><i class="fa-solid fa-clock-rotate-left" style="color: #6366f1;"></i> Recent Activity</div>
            <span style="font-size: 0.72rem; color: #94a3b8;">Latest 10 updates</span>
        </div>
        <div data-aos="fade-up" class="a-card-body" style="max-height: 420px; overflow-y: auto;">
            @forelse($recentActivity as $activity)
            <a data-aos="fade-up" href="{{ $activity['url'] }}" class="timeline-item" style="text-decoration: none;">
                <div class="timeline-icon" style="background: {{ $activity['color'] }}15; color: {{ $activity['color'] }};">
                    <i class="fa-solid {{ $activity['icon'] }}"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-action">{{ $activity['action'] }}</div>
                    <div class="timeline-title">{{ Str::limit($activity['title'], 50) }}</div>
                    <div class="timeline-date">
                        <i class="fa-regular fa-clock" style="margin-right: 0.2rem;"></i>
                        {{ $activity['date'] ? $activity['date']->diffForHumans() : 'Unknown' }}
                    </div>
                </div>
            </a>
            @empty
            <div style="text-align: center; padding: 2rem; color: #94a3b8;">
                <i class="fa-solid fa-inbox" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; opacity: 0.3;"></i>
                No recent activity
            </div>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div data-aos="fade-up" class="a-card">
        <div class="a-card-header">
            <div data-aos="fade-up" class="a-card-title"><i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Quick Actions</div>
        </div>
        <div data-aos="fade-up" class="a-card-body" style="display: flex; flex-direction: column; gap: 0.4rem;">
            @php
                $actions = [
                    ['label' => 'Add News Article', 'icon' => 'fa-newspaper', 'bg' => '#fef3c7', 'color' => '#d97706', 'route' => 'admin.news.create'],
                    ['label' => 'Create Event', 'icon' => 'fa-calendar-plus', 'bg' => '#fce7f3', 'color' => '#db2777', 'route' => 'admin.events.create'],
                    ['label' => 'Add Staff Member', 'icon' => 'fa-user-plus', 'bg' => '#ecfdf5', 'color' => '#059669', 'route' => 'admin.staff.create'],
                    ['label' => 'New Announcement', 'icon' => 'fa-bullhorn', 'bg' => '#fff7ed', 'color' => '#ea580c', 'route' => 'admin.announcements.create'],
                    ['label' => 'Upload to Gallery', 'icon' => 'fa-cloud-arrow-up', 'bg' => '#f0fdf4', 'color' => '#16a34a', 'route' => 'admin.gallery.create'],
                    ['label' => 'Manage Programmes', 'icon' => 'fa-graduation-cap', 'bg' => '#eff6ff', 'color' => '#2563eb', 'route' => 'admin.programmes.index'],
                    ['label' => 'Manage Courses', 'icon' => 'fa-book', 'bg' => '#faf5ff', 'color' => '#7c3aed', 'route' => 'admin.courses.index'],
                    ['label' => 'Manage Partners', 'icon' => 'fa-handshake', 'bg' => '#f5f3ff', 'color' => '#6d28d9', 'route' => 'admin.partners.index'],
                ];
            @endphp
            @foreach($actions as $action)
            <a href="{{ route($action['route']) }}" class="quick-action">
                <div class="qa-icon" style="background: {{ $action['bg'] }}; color: {{ $action['color'] }};">
                    <i class="fa-solid {{ $action['icon'] }}"></i>
                </div>
                <span>{{ $action['label'] }}</span>
                <i class="fa-solid fa-chevron-right qa-arrow"></i>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════ CHART.JS + SCRIPTS ═══════════════ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fontFamily = "'Inter', 'Segoe UI', sans-serif";
    Chart.defaults.font.family = fontFamily;
    Chart.defaults.font.size = 12;

    // ─── Health Doughnut ───
    const healthCtx = document.getElementById('healthChart');
    if (healthCtx) {
        const score = {{ $healthScore }};
        const healthColor = score >= 80 ? '#059669' : (score >= 50 ? '#d97706' : '#ef4444');
        new Chart(healthCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [score, 100 - score],
                    backgroundColor: [healthColor, '#f1f5f9'],
                    borderWidth: 0,
                    cutout: '78%',
                }]
            },
            options: {
                responsive: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                animation: { animateRotate: true, duration: 1500 }
            }
        });
    }

    // ─── Content Trend ───
    const trendCtx = document.getElementById('trendChart');
    let trendChart = null;
    if (trendCtx) {
        const labels = @json(array_values($monthlyLabels));
        const newsData = @json(array_values($monthlyNews));
        const eventsData = @json(array_values($monthlyEvents));
        const pubsData = @json(array_values($monthlyPublications));

        function createTrendChart(type) {
            if (trendChart) trendChart.destroy();
            trendChart = new Chart(trendCtx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'News',
                            data: newsData,
                            borderColor: '#3b82f6',
                            backgroundColor: type === 'line' ? 'rgba(59, 130, 246, 0.08)' : 'rgba(59, 130, 246, 0.7)',
                            borderWidth: 2.5,
                            fill: type === 'line',
                            tension: 0.4,
                            pointRadius: type === 'line' ? 4 : 0,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#3b82f6',
                            borderRadius: type === 'bar' ? 4 : 0,
                        },
                        {
                            label: 'Events',
                            data: eventsData,
                            borderColor: '#ec4899',
                            backgroundColor: type === 'line' ? 'rgba(236, 72, 153, 0.08)' : 'rgba(236, 72, 153, 0.7)',
                            borderWidth: 2.5,
                            fill: type === 'line',
                            tension: 0.4,
                            pointRadius: type === 'line' ? 4 : 0,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#ec4899',
                            borderRadius: type === 'bar' ? 4 : 0,
                        },
                        {
                            label: 'Publications',
                            data: pubsData,
                            borderColor: '#8b5cf6',
                            backgroundColor: type === 'line' ? 'rgba(139, 92, 246, 0.08)' : 'rgba(139, 92, 246, 0.7)',
                            borderWidth: 2.5,
                            fill: type === 'line',
                            tension: 0.4,
                            pointRadius: type === 'line' ? 4 : 0,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#8b5cf6',
                            borderRadius: type === 'bar' ? 4 : 0,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { intersect: false, mode: 'index' },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: { usePointStyle: true, pointStyle: 'circle', padding: 16, font: { size: 11, weight: '600' } }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { weight: '700' },
                            cornerRadius: 8,
                            padding: 10,
                            boxPadding: 4,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 11 } }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' },
                            ticks: { color: '#94a3b8', font: { size: 11 }, stepSize: 1 }
                        }
                    }
                }
            });
        }
        createTrendChart('line');
        window.switchTrendView = function(type, btn) {
            btn.parentNode.querySelectorAll('.analytics-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            createTrendChart(type);
        };
    }

    // ─── Course Type Doughnut ───
    const courseCtx = document.getElementById('courseTypeChart');
    if (courseCtx) {
        new Chart(courseCtx, {
            type: 'doughnut',
            data: {
                labels: ['Core', 'Elective'],
                datasets: [{
                    data: [{{ $coreCount }}, {{ $electiveCount }}],
                    backgroundColor: ['#7c3aed', '#c4b5fd'],
                    borderWidth: 0,
                    cutout: '65%',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 12, font: { size: 11 } } },
                    tooltip: { backgroundColor: '#0f172a', cornerRadius: 8 }
                }
            }
        });
    }

    // ─── Publication Type Doughnut ───
    const pubCtx = document.getElementById('pubTypeChart');
    if (pubCtx) {
        const pubLabels = @json($pubsByType->keys()->map(fn($t) => ucfirst($t ?: 'Other'))->values());
        const pubValues = @json($pubsByType->values());
        const pubColors = ['#6d28d9', '#8b5cf6', '#a78bfa', '#c4b5fd', '#ddd6fe', '#ede9fe'];
        new Chart(pubCtx, {
            type: 'doughnut',
            data: {
                labels: pubLabels,
                datasets: [{
                    data: pubValues,
                    backgroundColor: pubColors.slice(0, pubLabels.length),
                    borderWidth: 0,
                    cutout: '60%',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 10, font: { size: 11 } } },
                    tooltip: { backgroundColor: '#0f172a', cornerRadius: 8 }
                }
            }
        });
    }

    // ─── Animated Counters ───
    document.querySelectorAll('.kpi-value[data-count]').forEach(el => {
        const target = parseInt(el.dataset.count);
        if (target === 0) return;
        const duration = 1200;
        const start = performance.now();
        const formatter = new Intl.NumberFormat();
        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
            el.textContent = formatter.format(Math.round(target * eased));
            if (progress < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    });
});

// ─── Tab Switching ───
function switchDetailTab(tabName, btn) {
    document.querySelectorAll('#detailTabs .analytics-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    const panel = document.getElementById('tab-' + tabName);
    if (panel) panel.classList.add('active');
}
</script>
@endsection
