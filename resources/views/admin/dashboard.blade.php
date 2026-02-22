@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div style="margin-bottom: 2.5rem; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: #111827;">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
        <p style="margin: 0; color: #6b7280; font-size: 1.05rem;">Here's what's happening with the Department of Computer Science today.</p>
    </div>
    <div style="text-align: right;">
        <div style="font-size: 0.85rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">System Date</div>
        <div style="font-size: 1.25rem; font-weight: 600; color: var(--color-primary);">{{ now()->format('l, jS F Y') }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
    <!-- Staff Card -->
    <div class="admin-card" style="padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.05)';">
        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(59, 130, 246, 0.05); border-radius: 50%;"></div>
        <div style="z-index: 10;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500;">Total Staff</h3>
            <p style="margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1;">{{ $stats['staffCount'] }}</p>
        </div>
        <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>
    
    <!-- Programmes Card -->
    <div class="admin-card" style="padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.05)';">
        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(16, 185, 129, 0.05); border-radius: 50%;"></div>
        <div style="z-index: 10;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500;">Programmes</h3>
            <p style="margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1;">{{ $stats['programmesCount'] }}</p>
        </div>
        <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    
    <!-- Courses Card -->
    <div class="admin-card" style="padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.05)';">
        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(139, 92, 246, 0.05); border-radius: 50%;"></div>
        <div style="z-index: 10;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500;">Active Courses</h3>
            <p style="margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1;">{{ $stats['coursesCount'] }}</p>
        </div>
        <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">
            <i class="fa-solid fa-book-open"></i>
        </div>
    </div>
    
    <!-- News Card -->
    <div class="admin-card" style="padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -5px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.05)';">
        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(245, 158, 11, 0.05); border-radius: 50%;"></div>
        <div style="z-index: 10;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500;">News Articles</h3>
            <p style="margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1;">{{ $stats['newsCount'] }}</p>
        </div>
        <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">
            <i class="fa-solid fa-newspaper"></i>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem;">
    <!-- Recent News Panel -->
    <div class="admin-card" style="display: flex; flex-direction: column;">
        <div style="padding: 1.5rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between;">
            <h3 style="margin: 0; font-size: 1.15rem; color: #1f2937; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-bullhorn" style="color: var(--color-primary);"></i> Recent News
            </h3>
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm" style="background: var(--color-primary); color: white; padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px; text-decoration: none;"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div style="padding: 0 1.5rem; flex: 1;">
            @forelse($recentNews as $news)
            <div style="padding: 1.25rem 0; border-bottom: 1px solid #f3f4f6; display: flex; gap: 1rem; align-items: start; transition: background 0.2s; margin: 0 -1.5rem; padding-left: 1.5rem; padding-right: 1.5rem;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $news->is_published ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $news->is_published ? '#10b981' : '#f59e0b' }}; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">
                    <i class="fa-solid {{ $news->is_published ? 'fa-check' : 'fa-pen-ruler' }}"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h4 style="margin: 0 0 0.3rem 0; font-size: 1rem; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <a href="{{ route('admin.news.edit', $news) }}" style="color: inherit; text-decoration: none;">{{ $news->title }}</a>
                    </h4>
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; color: #6b7280;">
                        <span><i class="fa-regular fa-clock"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->diffForHumans() : 'Draft' }}</span>
                        <span style="width: 4px; height: 4px; background: #d1d5db; border-radius: 50%;"></span>
                        <span style="background: #e5e7eb; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; color: #4b5563;">{{ $news->category }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div style="padding: 2.5rem 0; text-align: center; color: #9ca3af;">
                <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                <p style="margin: 0; font-size: 0.95rem;">No news articles available yet.</p>
            </div>
            @endforelse
        </div>
        
        <div style="padding: 1rem 1.5rem; background: #f8fafc; text-align: center; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
            <a href="{{ route('admin.news.index') }}" style="color: var(--color-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.2s;" onmouseover="this.style.gap='0.6rem'" onmouseout="this.style.gap='0.4rem'">
                View All Articles <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Upcoming Events Panel -->
    <div class="admin-card" style="display: flex; flex-direction: column;">
        <div style="padding: 1.5rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between;">
            <h3 style="margin: 0; font-size: 1.15rem; color: #1f2937; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-regular fa-calendar-check" style="color: var(--color-primary);"></i> Upcoming Events
            </h3>
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm" style="background: var(--color-primary); color: white; padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px; text-decoration: none;"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        
        <div style="padding: 0 1.5rem; flex: 1;">
            @forelse($upcomingEvents as $event)
            <div style="padding: 1.25rem 0; border-bottom: 1px solid #f3f4f6; display: flex; gap: 1rem; align-items: start; transition: background 0.2s; margin: 0 -1.5rem; padding-left: 1.5rem; padding-right: 1.5rem;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                <div style="width: 48px; height: 52px; border-radius: 8px; border: 1px solid #e5e7eb; background: white; display: flex; flex-direction: column; overflow: hidden; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div style="background: var(--color-primary); color: white; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; text-align: center; padding: 2px 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; color: #1f2937;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h4 style="margin: 0 0 0.3rem 0; font-size: 1rem; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <a href="{{ route('admin.events.edit', $event) }}" style="color: inherit; text-decoration: none;">{{ $event->title }}</a>
                    </h4>
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; color: #6b7280;">
                        <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->time ?? $event->date)->format('h:i A') }}</span>
                        @if($event->location)
                        <span style="width: 4px; height: 4px; background: #d1d5db; border-radius: 50%;"></span>
                        <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="padding: 2.5rem 0; text-align: center; color: #9ca3af;">
                <i class="fa-regular fa-calendar-xmark" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                <p style="margin: 0; font-size: 0.95rem;">No upcoming events scheduled.</p>
            </div>
            @endforelse
        </div>
        
        <div style="padding: 1rem 1.5rem; background: #f8fafc; text-align: center; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
            <a href="{{ route('admin.events.index') }}" style="color: var(--color-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.2s;" onmouseover="this.style.gap='0.6rem'" onmouseout="this.style.gap='0.4rem'">
                View Full Calendar <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection
