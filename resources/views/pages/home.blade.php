@extends('layouts.public')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero" style="background: var(--color-primary); padding: 6rem 0; color: white; text-align: center; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 1;">
        <h1 style="color:white; font-size: 3rem; margin-bottom: 1rem;">Empowering the Future of Computing</h1>
        <p style="font-size: 1.2rem; margin-bottom: 2rem; max-width: 800px; margin-left: auto; margin-right: auto;">Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.</p>
        <a href="/about" class="btn btn-accent" style="margin-right: 1rem;">Explore Our Department</a>
        <a href="/academics" class="btn" style="border: 1px solid white; color: white; background: transparent;">View Programmes</a>
    </div>
</section>

<!-- Stats Bar -->
<section class="stats-bar" style="background: var(--color-primary-light); color: white; padding: 2rem 0; border-top: 2px solid var(--color-accent);">
    <div class="container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
        <div class="stat-item text-center">
            <h2 style="color: var(--color-accent); font-size: 2.5rem; margin-bottom: 0;">{{ config('university.established') }}</h2>
            <p style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Established</p>
        </div>
        <div class="stat-item text-center">
            <h2 style="color: var(--color-accent); font-size: 2.5rem; margin-bottom: 0;">{{ $programmes->count() }}</h2>
            <p style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Programmes</p>
        </div>
        <div class="stat-item text-center">
            <h2 style="color: var(--color-accent); font-size: 2.5rem; margin-bottom: 0;">{{ $staffCount }}+</h2>
            <p style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Expert Faculty</p>
        </div>
    </div>
</section>

<!-- Announcements Bar -->
@if($announcements->count() > 0)
<section style="background: #fff3cd; border-bottom: 1px solid #ffe69c; padding: 1rem 0;">
    <div class="container">
        <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 2rem; overflow-x: auto;">
            @foreach($announcements as $announcement)
            <li style="white-space: nowrap; color: #856404; font-size: 0.95rem;">
                <i class="fa-solid fa-bullhorn" style="margin-right: 5px;"></i> 
                <strong>{{ $announcement->title }}:</strong> {{ Str::limit($announcement->body, 80) }}
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

<!-- HOD Welcome -->
<section class="hod-welcome reveal" style="padding: var(--spacing-xl) 0; background: var(--color-bg-alt);">
    <div class="container page-layout" style="align-items: center;">
        <div class="hod-image" style="flex: 0 0 350px;">
            @if($hod)
               <div style="background: var(--color-border); aspect-ratio: 1; border-radius: 8px; overflow: hidden;">
                   @if($hod->photo)
                       <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                   @else
                       <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#ccc; color:#666; font-size:4rem;"><i class="fa-solid fa-user-tie"></i></div>
                   @endif
               </div>
            @endif
        </div>
        <div class="hod-text main-content">
            <h2>Welcome from the Head of Department</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <p style="font-size: 1.15rem; color: var(--color-text-muted); font-style: italic; line-height: 1.8; margin-bottom: 1.5rem;">
                "{!! nl2br(e(\App\Models\DepartmentSetting::where('key','hod_welcome_message')->value('value'))) !!}"
            </p>
            @if($hod)
                <p><strong>{{ $hod->name }}</strong><br><span style="color: var(--color-primary-light);">{{ $hod->title }}, Head of Department</span></p>
            @endif
        </div>
    </div>
</section>

<!-- Programmes -->
<section class="programmes reveal" style="padding: var(--spacing-xl) 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: var(--spacing-lg);">
            <h2>Academic Programmes</h2>
            <p style="color: var(--color-text-muted); max-width: 600px; margin: 0 auto;">We offer comprehensive undergraduate and postgraduate programmes tailored to the dynamic IT industry.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--spacing-md);">
            @foreach($programmes as $prog)
            <div style="background: var(--color-bg-main); border: 1px solid var(--color-border); border-radius: 8px; padding: 2rem; transition: transform 0.3s, box-shadow 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                <div style="color: var(--color-accent); font-size: 2rem; margin-bottom: 1rem;">
                    @if($prog->level === 'BSc') <i class="fa-solid fa-laptop-code"></i>
                    @elseif($prog->level === 'MSc') <i class="fa-solid fa-server"></i>
                    @else <i class="fa-solid fa-microchip"></i> @endif
                </div>
                <h3>{{ $prog->name }}</h3>
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.85rem; color: var(--color-text-muted);">
                    <span><i class="fa-regular fa-clock"></i> {{ $prog->duration }}</span>
                    <span><i class="fa-solid fa-book-open"></i> {{ $prog->mode_of_study }}</span>
                </div>
                <p style="color: var(--color-text-muted); font-size: 0.95rem;">{{ Str::limit($prog->description, 120) }}</p>
                <a href="/academics#{{ $prog->slug }}" style="display: inline-block; margin-top: 1rem; font-weight: 600;">Learn More &rarr;</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- News & Events Split -->
<section class="news-events reveal" style="padding: var(--spacing-xl) 0; background: var(--color-bg-alt);">
    <div class="container page-layout">
        <!-- News -->
        <div class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
                <h2>Latest News</h2>
                <a href="/research-news" class="btn btn-secondary" style="font-size: 0.85rem; padding: 0.4rem 0.8rem;">View All</a>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
                @forelse($news as $item)
                <div style="display: flex; gap: 1rem; background: var(--color-bg-main); padding: 1rem; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                    @if($item->featured_image)
                    <div style="width: 100px; height: 100px; flex-shrink: 0; background: #eee; border-radius: 4px;">
                        <img src="{{ asset('storage/'.$item->featured_image) }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    @endif
                    <div>
                        <span style="font-size: 0.8rem; color: var(--color-text-muted); text-transform: uppercase;">{{ $item->category }}</span>
                        <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem;"><a href="/news/{{ $item->slug }}" style="color: var(--color-text-main);">{{ $item->title }}</a></h3>
                        <p style="font-size: 0.9rem; color: var(--color-text-muted); margin: 0;">{{ Str::limit(strip_tags($item->body), 100) }}</p>
                    </div>
                </div>
                @empty
                <p>No recent news articles.</p>
                @endforelse
            </div>
        </div>
        
        <!-- Events -->
        <div class="sidebar-toc" style="width: 350px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
                <h2>Upcoming Events</h2>
            </div>
            
            <div style="background: var(--color-bg-main); border-radius: 8px; padding: 1.5rem; border-top: 4px solid var(--color-accent);">
                @forelse($events as $event)
                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--color-border);">
                    <div style="text-align: center; min-width: 60px;">
                        <span style="display: block; font-size: 0.8rem; text-transform: uppercase; color: var(--color-secondary); font-weight: 600;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span style="display: block; font-size: 1.8rem; font-weight: 700; color: var(--color-primary); line-height: 1;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                    </div>
                    <div>
                        <h4 style="font-size: 1.05rem; margin-bottom: 0.25rem;">{{ $event->title }}</h4>
                        <p style="font-size: 0.85rem; color: var(--color-text-muted); margin: 0;"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                        @if($event->venue)
                        <p style="font-size: 0.85rem; color: var(--color-text-muted); margin: 0;"><i class="fa-solid fa-location-dot"></i> {{ $event->venue }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <p>No upcoming events.</p>
                @endforelse
                <a href="/research-news#events" style="font-size: 0.9rem; font-weight: 600;">View Full Calendar &rarr;</a>
            </div>
        </div>
    </div>
</section>
@endsection
