@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div class="dashboard-header" style="flex-wrap: wrap; gap: 1.5rem;">
    <div style="flex: 1; min-width: 280px;">
        <h2 class="dashboard-title">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
        <p class="dashboard-subtitle">Here's what's happening with the Department of Computer Science today.</p>
    </div>
    <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
        <div class="dashboard-date-widget" style="margin: 0; padding: 1rem; background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; flex-direction: column; justify-content: center;">
            <div class="date-label" style="font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">System Date</div>
            <div class="date-value" style="font-size: 1.1rem; color: #111827; font-weight: 700;">{{ now()->format('l, jS F Y') }}</div>
        </div>

        <div style="padding: 0.75rem 1rem; background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex: 1; min-width: 320px;">
            <div style="font-size: 0.8rem; color: var(--color-primary, #2563eb); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: 0.4rem;">Academic Session & Semester</div>
            <form action="{{ route('admin.settings.academic-session') }}" method="POST" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                @csrf
                <input type="text" name="academic_session" value="{{ \App\Models\DepartmentSetting::getCached('academic_session', '2024/2025') }}" placeholder="e.g. 2025/2026" required style="padding: 0.45rem 0.6rem; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.95rem; width: 110px; outline: none; flex-grow: 1;">
                <select name="academic_semester" required style="padding: 0.45rem 0.6rem; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.95rem; outline: none; flex-grow: 2; min-width: 140px;">
                    @php $curSem = \App\Models\DepartmentSetting::getCached('academic_semester', 'First'); @endphp
                    <option value="First" {{ $curSem == 'First' ? 'selected' : '' }}>First Semester</option>
                    <option value="Second" {{ $curSem == 'Second' ? 'selected' : '' }}>Second Semester</option>
                    <option value="Third" {{ $curSem == 'Third' ? 'selected' : '' }}>Third Semester</option>
                </select>
                <button type="submit" style="background: var(--color-primary, #2563eb); color: white; border: none; padding: 0.45rem 1rem; border-radius: 4px; font-weight: 600; cursor: pointer; transition: background 0.2s; flex-grow: 1;">Set</button>
            </form>
        </div>
    </div>
</div>

<div class="dashboard-stats-grid">
    <!-- Staff Card -->
    <div data-aos="fade-up" class="admin-card stat-card">
        <div data-aos="fade-up" class="stat-card-bg-circle color-blue"></div>
        <div class="stat-content">
            <h3 class="stat-label">Total Staff</h3>
            <p class="stat-value">{{ $stats['staffCount'] }}</p>
        </div>
        <div data-aos="fade-up" class="stat-icon-box color-blue">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>
    
    <!-- Programmes Card -->
    <div data-aos="fade-up" class="admin-card stat-card">
        <div data-aos="fade-up" class="stat-card-bg-circle color-green"></div>
        <div class="stat-content">
            <h3 class="stat-label">Programmes</h3>
            <p class="stat-value">{{ $stats['programmesCount'] }}</p>
        </div>
        <div data-aos="fade-up" class="stat-icon-box color-green">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    
    <!-- Courses Card -->
    <div data-aos="fade-up" class="admin-card stat-card">
        <div data-aos="fade-up" class="stat-card-bg-circle color-purple"></div>
        <div class="stat-content">
            <h3 class="stat-label">Active Courses</h3>
            <p class="stat-value">{{ $stats['coursesCount'] }}</p>
        </div>
        <div data-aos="fade-up" class="stat-icon-box color-purple">
            <i class="fa-solid fa-book-open"></i>
        </div>
    </div>
    
    <!-- News Card -->
    <div data-aos="fade-up" class="admin-card stat-card">
        <div data-aos="fade-up" class="stat-card-bg-circle color-orange"></div>
        <div class="stat-content">
            <h3 class="stat-label">News Articles</h3>
            <p class="stat-value">{{ $stats['newsCount'] }}</p>
        </div>
        <div data-aos="fade-up" class="stat-icon-box color-orange">
            <i class="fa-solid fa-newspaper"></i>
        </div>
    </div>
</div>

{{-- Secondary Stats Row --}}
<div class="secondary-stats-grid">
    @php
    $secondaryStats = [
        ['label' => 'Upcoming Events', 'value' => $stats['eventsCount'], 'icon' => 'fa-calendar-check', 'color' => '#ec4899', 'bg' => 'rgba(236,72,153,0.1)'],
        ['label' => 'Announcements', 'value' => $stats['announcementsCount'], 'icon' => 'fa-bullhorn', 'color' => '#ea580c', 'bg' => 'rgba(234,88,12,0.1)'],
        ['label' => 'Gallery Albums', 'value' => $stats['albumsCount'], 'icon' => 'fa-images', 'color' => '#0891b2', 'bg' => 'rgba(8,145,178,0.1)'],
        ['label' => 'Publications', 'value' => $stats['publicationsCount'], 'icon' => 'fa-book', 'color' => '#7c3aed', 'bg' => 'rgba(124,58,237,0.1)'],
        ['label' => 'NACOS Presidents', 'value' => $stats['presidentsCount'], 'icon' => 'fa-crown', 'color' => '#d97706', 'bg' => 'rgba(217,119,6,0.1)'],
        ['label' => 'Past HODs', 'value' => $stats['hodsCount'], 'icon' => 'fa-user-graduate', 'color' => '#059669', 'bg' => 'rgba(5,150,105,0.1)'],
    ];
    @endphp
    @foreach($secondaryStats as $ss)
    <div data-aos="fade-up" class="secondary-stat-card">
        <div class="secondary-stat-icon" style="background: {{ $ss['bg'] }}; color: {{ $ss['color'] }};">
            <i class="fa-solid {{ $ss['icon'] }}"></i>
        </div>
        <div style="flex: 1;">
            <div class="secondary-stat-value">{{ number_format($ss['value']) }}</div>
            <div class="secondary-stat-label">{{ $ss['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="dashboard-panels-grid">
    <!-- Recent News Panel -->
    <div data-aos="fade-up" class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-bullhorn" style="color: var(--color-primary);"></i> Recent News
            </h3>
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div class="panel-body">
            @forelse($recentNews as $news)
            <div data-aos="fade-up" class="panel-list-item">
                <div class="news-list-icon" style="background: {{ $news->is_published ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $news->is_published ? '#10b981' : '#f59e0b' }};">
                    <i class="fa-solid {{ $news->is_published ? 'fa-check' : 'fa-pen-ruler' }}"></i>
                </div>
                <div data-aos="fade-up" class="item-content">
                    <h4 class="item-title">
                        <a data-aos="fade-up" href="{{ route('admin.news.edit', $news) }}" class="item-link">{{ $news->title }}</a>
                    </h4>
                    <div data-aos="fade-up" class="item-meta">
                        <span><i class="fa-regular fa-clock"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->diffForHumans() : 'Draft' }}</span>
                        <span class="meta-dot"></span>
                        <span class="meta-badge">{{ $news->category }}</span>
                        <span class="meta-dot"></span>
                        <span title="Reactions" style="margin-right: 0.3rem;"><i class="fa-regular fa-thumbs-up" style="color: var(--color-primary);"></i> {{ $news->reactions_count ?? 0 }}</span>
                        <span title="Comments"><i class="fa-regular fa-comment" style="color: #64748b;"></i> {{ $news->comments_count ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-solid fa-folder-open panel-empty-icon"></i>
                <p class="panel-empty-text">No news articles available yet.</p>
            </div>
            @endforelse
        </div>
        
        <div class="panel-footer">
            <a href="{{ route('admin.news.index') }}" class="panel-view-all">
                View All Articles <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Upcoming Events Panel -->
    <div data-aos="fade-up" class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-regular fa-calendar-check" style="color: var(--color-primary);"></i> Upcoming Events
            </h3>
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div class="panel-body">
            @forelse($upcomingEvents as $event)
            <div data-aos="fade-up" class="panel-list-item">
                <div class="event-date-badge">
                    <div class="event-month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div class="event-day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div data-aos="fade-up" class="item-content">
                    <h4 class="item-title">
                        <a data-aos="fade-up" href="{{ route('admin.events.edit', $event) }}" class="item-link">{{ $event->title }}</a>
                    </h4>
                    <div data-aos="fade-up" class="item-meta">
                        <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->time ?? $event->date)->format('h:i A') }}</span>
                        @if($event->location)
                        <span class="meta-dot"></span>
                        <span class="meta-location"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-regular fa-calendar-xmark panel-empty-icon"></i>
                <p class="panel-empty-text">No upcoming events scheduled.</p>
            </div>
            @endforelse
        </div>
        
        <div class="panel-footer">
            <a href="{{ route('admin.events.index') }}" class="panel-view-all">
                View Full Calendar <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Media Optimization Panel -->
    <div data-aos="fade-up" class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-image" style="color: var(--color-primary);"></i> Media Optimization (WebP)
            </h3>
            <a href="{{ route('admin.media-optimization.index') }}" class="btn btn-sm panel-new-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Analyze
            </a>
        </div>

        <div class="panel-body">
            @php
                $pending = $mediaStatusCounts['pending'] ?? 0;
                $processing = $mediaStatusCounts['processing'] ?? 0;
                $ready = $mediaStatusCounts['ready'] ?? 0;
                $failed = $mediaStatusCounts['failed'] ?? 0;
            @endphp

            <div style="margin-bottom: 0.75rem; padding: 0.75rem 0.85rem; border-radius: 10px; background: #f8fafc; border: 1px solid #e2e8f0;">
                <div style="font-weight: 800; color: #334155; font-size: 0.9rem; margin-bottom: 0.25rem;">
                    <i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.35rem; color: var(--color-primary);"></i>
                    Last WebP Conversion
                </div>
                <div style="color: #64748b; font-size: 0.88rem;">
                    {{ isset($mediaLastConvertedAt) && $mediaLastConvertedAt ? \Carbon\Carbon::parse($mediaLastConvertedAt)->diffForHumans() : '—' }}
                </div>
            </div>

            <div style="margin-bottom: 1rem; padding: 0.75rem 0.85rem; border-radius: 10px; background: #fef2f2; border: 1px solid #fecaca;">
                <div style="font-weight: 800; color: #7f1d1d; font-size: 0.9rem; margin-bottom: 0.25rem;">
                    <i class="fa-solid fa-triangle-exclamation" style="margin-right: 0.35rem; color: #dc2626;"></i>
                    Last WebP Failure
                </div>
                <div style="color: #7f1d1d; font-size: 0.88rem;">
                    {{ isset($mediaLastFailedAt) && $mediaLastFailedAt ? \Carbon\Carbon::parse($mediaLastFailedAt)->diffForHumans() : '—' }}
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; margin-bottom: 1rem;">
                <div data-aos="fade-up" class="admin-card" style="padding: 0.85rem; background: #fffbeb; border: 1px solid #fde68a;">
                    <div style="font-weight: 800; color: #d97706;">Pending</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #b45309;">{{ $pending }}</div>
                </div>
                <div data-aos="fade-up" class="admin-card" style="padding: 0.85rem; background: #f0f9ff; border: 1px solid #bae6fd;">
                    <div style="font-weight: 800; color: #0ea5e9;">Processing</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #0369a1;">{{ $processing }}</div>
                </div>
                <div data-aos="fade-up" class="admin-card" style="padding: 0.85rem; background: #ecfdf5; border: 1px solid #bbf7d0;">
                    <div style="font-weight: 800; color: #10b981;">Ready</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #059669;">{{ $ready }}</div>
                </div>
                <div data-aos="fade-up" class="admin-card" style="padding: 0.85rem; background: #fef2f2; border: 1px solid #fecaca;">
                    <div style="font-weight: 800; color: #ef4444;">Failed</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #dc2626;">{{ $failed }}</div>
                </div>
            </div>

            <div style="margin-top: 0.75rem;">
                <h4 style="margin: 0 0 0.75rem; font-size: 0.95rem; color: #334155;">
                    <i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.35rem;"></i>
                    Recent WebP Conversions
                </h4>

                @forelse($recentMedia as $media)
                    @php
                        $readyCount = $media->derivatives->where('status', 'ready')->count();
                        $failedCount = $media->derivatives->where('status', 'failed')->count();
                    @endphp
                    <div data-aos="fade-up" class="panel-list-item" style="margin-bottom: 0.75rem;">
                        <div class="news-list-icon" style="background: rgba(22,163,74,0.08); color: #0f172a;">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div data-aos="fade-up" class="item-content">
                            <h4 class="item-title" style="margin: 0 0 0.25rem;">
                                Media #{{ $media->id }}
                            </h4>
                            <div data-aos="fade-up" class="item-meta">
                                <span>
                                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                                    {{ $readyCount }}/3 ready
                                </span>
                                @if($failedCount > 0)
                                    <span class="meta-dot"></span>
                                    <span style="color: #ef4444; font-weight: 700;">{{ $failedCount }} failed</span>
                                @endif
                            </div>
                            <div style="color: #6b7280; font-size: 0.82rem; margin-top: 0.35rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $media->original_path }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="panel-empty-state">
                        <i class="fa-solid fa-file-image panel-empty-icon"></i>
                        <p class="panel-empty-text">No media conversion data yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
