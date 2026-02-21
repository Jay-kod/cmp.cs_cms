@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="admin-card" style="border-left: 4px solid var(--color-primary); display: flex; align-items: center; gap: 1rem;">
        <div style="font-size: 2.5rem; color: var(--color-primary); opacity: 0.8;"><i class="fa-solid fa-users"></i></div>
        <div>
            <h3 style="margin: 0; font-size: 1rem; color: #6b7280;">Total Staff</h3>
            <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #111827;">{{ $stats['staffCount'] }}</p>
        </div>
    </div>
    <div class="admin-card" style="border-left: 4px solid var(--color-secondary); display: flex; align-items: center; gap: 1rem;">
        <div style="font-size: 2.5rem; color: var(--color-secondary); opacity: 0.8;"><i class="fa-solid fa-graduation-cap"></i></div>
        <div>
            <h3 style="margin: 0; font-size: 1rem; color: #6b7280;">Programmes</h3>
            <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #111827;">{{ $stats['programmesCount'] }}</p>
        </div>
    </div>
    <div class="admin-card" style="border-left: 4px solid #10B981; display: flex; align-items: center; gap: 1rem;">
        <div style="font-size: 2.5rem; color: #10B981; opacity: 0.8;"><i class="fa-solid fa-book"></i></div>
        <div>
            <h3 style="margin: 0; font-size: 1rem; color: #6b7280;">Courses</h3>
            <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #111827;">{{ $stats['coursesCount'] }}</p>
        </div>
    </div>
    <div class="admin-card" style="border-left: 4px solid var(--color-accent); display: flex; align-items: center; gap: 1rem;">
        <div style="font-size: 2.5rem; color: var(--color-accent); opacity: 0.8;"><i class="fa-solid fa-newspaper"></i></div>
        <div>
            <h3 style="margin: 0; font-size: 1rem; color: #6b7280;">News Articles</h3>
            <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #111827;">{{ $stats['newsCount'] }}</p>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem;">
    <div class="admin-card">
        <h3 style="margin-top: 0; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1rem;">Recent News</h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
            @forelse($recentNews as $news)
            <li style="padding: 0.8rem 0; border-bottom: 1px solid #f3f4f6; display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h4 style="margin: 0; font-size: 0.95rem;">{{ $news->title }}</h4>
                    <span style="font-size: 0.8rem; color: #6b7280;">{{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->diffForHumans() : 'Draft' }}</span>
                </div>
                <span style="font-size: 0.75rem; background: #e5e7eb; padding: 2px 8px; border-radius: 10px;">{{ $news->category }}</span>
            </li>
            @empty
            <li style="padding: 0.8rem 0; color: #6b7280;">No news articles available.</li>
            @endforelse
        </ul>
        <a href="{{ route('admin.news.index') }}" style="display: block; text-align: center; margin-top: 1rem; font-size: 0.85rem; font-weight: 500; color: var(--color-secondary);">View All News &rarr;</a>
    </div>
    
    <div class="admin-card">
        <h3 style="margin-top: 0; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1rem;">Upcoming Events</h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
            @forelse($upcomingEvents as $event)
            <li style="padding: 0.8rem 0; border-bottom: 1px solid #f3f4f6; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="margin: 0; font-size: 0.95rem;">{{ $event->title }}</h4>
                    <span style="font-size: 0.8rem; color: #6b7280;"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->date)->format('M d, Y h:i A') }}</span>
                </div>
                <span style="font-size: 0.75rem; color: var(--color-primary); font-weight: 600;">{{ \Carbon\Carbon::parse($event->date)->diffForHumans() }}</span>
            </li>
            @empty
            <li style="padding: 0.8rem 0; color: #6b7280;">No upcoming events.</li>
            @endforelse
        </ul>
        <a href="{{ route('admin.events.index') }}" style="display: block; text-align: center; margin-top: 1rem; font-size: 0.85rem; font-weight: 500; color: var(--color-secondary);">View Calendar &rarr;</a>
    </div>
</div>
@endsection
