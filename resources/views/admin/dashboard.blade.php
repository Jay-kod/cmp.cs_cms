@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div class="dashboard-header">
    <div>
        <h2 class="dashboard-title">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
        <p class="dashboard-subtitle">Here's what's happening with the Department of Computer Science today.</p>
    </div>
    <div class="dashboard-date-widget">
        <div class="date-label">System Date</div>
        <div class="date-value">{{ now()->format('l, jS F Y') }}</div>
    </div>
</div>

<div class="dashboard-stats-grid">
    <!-- Staff Card -->
    <div class="admin-card stat-card">
        <div class="stat-card-bg-circle color-blue"></div>
        <div class="stat-content">
            <h3 class="stat-label">Total Staff</h3>
            <p class="stat-value">{{ $stats['staffCount'] }}</p>
        </div>
        <div class="stat-icon-box color-blue">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>
    
    <!-- Programmes Card -->
    <div class="admin-card stat-card">
        <div class="stat-card-bg-circle color-green"></div>
        <div class="stat-content">
            <h3 class="stat-label">Programmes</h3>
            <p class="stat-value">{{ $stats['programmesCount'] }}</p>
        </div>
        <div class="stat-icon-box color-green">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    
    <!-- Courses Card -->
    <div class="admin-card stat-card">
        <div class="stat-card-bg-circle color-purple"></div>
        <div class="stat-content">
            <h3 class="stat-label">Active Courses</h3>
            <p class="stat-value">{{ $stats['coursesCount'] }}</p>
        </div>
        <div class="stat-icon-box color-purple">
            <i class="fa-solid fa-book-open"></i>
        </div>
    </div>
    
    <!-- News Card -->
    <div class="admin-card stat-card">
        <div class="stat-card-bg-circle color-orange"></div>
        <div class="stat-content">
            <h3 class="stat-label">News Articles</h3>
            <p class="stat-value">{{ $stats['newsCount'] }}</p>
        </div>
        <div class="stat-icon-box color-orange">
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
    <div class="admin-card secondary-stat-card">
        <div class="secondary-stat-icon" style="background: {{ $ss['bg'] }}; color: {{ $ss['color'] }};">
            <i class="fa-solid {{ $ss['icon'] }}"></i>
        </div>
        <div>
            <div class="secondary-stat-value">{{ $ss['value'] }}</div>
            <div class="secondary-stat-label">{{ $ss['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="dashboard-panels-grid">
    <!-- Recent News Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-bullhorn" style="color: var(--color-primary);"></i> Recent News
            </h3>
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div class="panel-body">
            @forelse($recentNews as $news)
            <div class="panel-list-item">
                <div class="news-list-icon" style="background: {{ $news->is_published ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $news->is_published ? '#10b981' : '#f59e0b' }};">
                    <i class="fa-solid {{ $news->is_published ? 'fa-check' : 'fa-pen-ruler' }}"></i>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('admin.news.edit', $news) }}" class="item-link">{{ $news->title }}</a>
                    </h4>
                    <div class="item-meta">
                        <span><i class="fa-regular fa-clock"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->diffForHumans() : 'Draft' }}</span>
                        <span class="meta-dot"></span>
                        <span class="meta-badge">{{ $news->category }}</span>
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
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-regular fa-calendar-check" style="color: var(--color-primary);"></i> Upcoming Events
            </h3>
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div class="panel-body">
            @forelse($upcomingEvents as $event)
            <div class="panel-list-item">
                <div class="event-date-badge">
                    <div class="event-month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div class="event-day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('admin.events.edit', $event) }}" class="item-link">{{ $event->title }}</a>
                    </h4>
                    <div class="item-meta">
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
</div>
@endsection
