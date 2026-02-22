@extends('layouts.public')
@section('title', 'Research & News')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $heroSetting = \App\Models\DepartmentSetting::where('key', 'hero_blog')->first();
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp
<!-- Hero Section -->
<div class="blog-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(4, 120, 87, 0.9) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    
    <!-- Floating Decorative Elements -->
    <div style="position: absolute; top: 15%; left: 10%; width: 150px; height: 150px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 10%; right: 5%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 15%; right: 25%; font-size: 8rem; color: rgba(255,255,255,0.02); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-microscope"></i></div>
    
    <div class="container" style="position: relative; z-index: 10; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-newspaper" style="font-size: 0.7rem;"></i> {{ $gs('blog_hero_badge', 'Innovation & Insights') }}
        </div>
        <h1 style="color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gs('blog_hero_title', 'Research, News & Events') }}</h1>
        <p style="color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">{{ $gs('blog_hero_subtitle', 'Stay updated with our latest technological breakthroughs, departmental highlights, and upcoming academic events.') }}</p>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content blog-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        {{-- ═══════════ CORE RESEARCH AREAS ═══════════ --}}
        <section id="research-areas" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(168, 85, 247, 0.1)); color: #8b5cf6; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Core Research Areas</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #8b5cf6, #a855f7); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="blog-research-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <!-- AI -->
                <div style="background: #faf5ff; padding: 2rem 1.8rem; border-radius: 14px; border: 1px solid #e9d5ff; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px -10px rgba(139,92,246,0.2)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fa-solid fa-brain" style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(139,92,246,0.05); transform: rotate(15deg); pointer-events: none;"></i>
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.2rem; box-shadow: 0 8px 15px -4px rgba(139,92,246,0.3); position: relative; z-index: 2;">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 style="margin: 0 0 0.8rem; font-size: 1.25rem; color: #4c1d95; font-family: var(--font-heading); position: relative; z-index: 2;">Artificial Intelligence</h3>
                    <p style="margin: 0; font-size: 0.95rem; color: #5b21b6; line-height: 1.6; position: relative; z-index: 2;">Machine learning, natural language processing, and computer vision pushing the boundaries of autonomous systems.</p>
                </div>

                <!-- Cybersecurity -->
                <div style="background: #ef44440c; padding: 2rem 1.8rem; border-radius: 14px; border: 1px solid #fecaca; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px -10px rgba(239,68,68,0.2)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fa-solid fa-shield-halved" style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(239,68,68,0.05); transform: rotate(15deg); pointer-events: none;"></i>
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.2rem; box-shadow: 0 8px 15px -4px rgba(239,68,68,0.3); position: relative; z-index: 2;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 style="margin: 0 0 0.8rem; font-size: 1.25rem; color: #991b1b; font-family: var(--font-heading); position: relative; z-index: 2;">Cybersecurity</h3>
                    <p style="margin: 0; font-size: 0.95rem; color: #7f1d1d; line-height: 1.6; position: relative; z-index: 2;">Cryptography, network security, and robust threat detection for an increasingly connected world.</p>
                </div>

                <!-- Data Science -->
                <div style="background: #eff6ff; padding: 2rem 1.8rem; border-radius: 14px; border: 1px solid #bfdbfe; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px -10px rgba(59,130,246,0.2)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fa-solid fa-database" style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(59,130,246,0.05); transform: rotate(15deg); pointer-events: none;"></i>
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.2rem; box-shadow: 0 8px 15px -4px rgba(59,130,246,0.3); position: relative; z-index: 2;">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <h3 style="margin: 0 0 0.8rem; font-size: 1.25rem; color: #1e3a8a; font-family: var(--font-heading); position: relative; z-index: 2;">Data Science</h3>
                    <p style="margin: 0; font-size: 0.95rem; color: #1d4ed8; line-height: 1.6; position: relative; z-index: 2;">Big data analytics, data mining, and statistical modeling applied to health, agriculture, and finance.</p>
                </div>
            </div>
        </section>

        {{-- ═══════════ RECENT PUBLICATIONS ═══════════ --}}
        <section id="publications" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(14, 165, 233, 0.1)); color: #0891b2; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-book-journal-whills"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Recent Publications</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #0891b2, #0ea5e9); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-pub-list" style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($publications as $index => $pub)
                @php
                    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'];
                    $pc = $colors[$index % 4];
                @endphp
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; border-left: 4px solid {{ $pc }}; display: flex; flex-direction: column; gap: 0.8rem; transition: transform 0.2s, box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateX(6px)'; this.style.boxShadow='0 8px 20px -5px rgba(0,0,0,0.05)'"
                     onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                    
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">
                        <h4 style="margin: 0; font-size: 1.15rem; color: #1e293b; line-height: 1.5;">{{ $pub->title }}</h4>
                        <span style="background: {{ $pc }}15; color: {{ $pc }}; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; white-space: nowrap;">{{ $pub->type }}</span>
                    </div>
                    
                    <div style="font-size: 0.95rem; color: #64748b; display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
                        <span style="color: #334155; font-weight: 600;"><i class="fa-solid fa-user-pen" style="color: #94a3b8; margin-right: 4px;"></i> {{ $pub->staff ? $pub->staff->name : 'Department Researcher' }}</span>
                        <span><i class="fa-solid fa-book" style="color: #94a3b8; margin-right: 4px;"></i> <em>{{ $pub->journal }}</em></span>
                        <span style="background: #f1f5f9; padding: 0.1rem 0.5rem; border-radius: 4px; font-size: 0.85rem;"><i class="fa-regular fa-calendar" style="color: #94a3b8;"></i> {{ $pub->year }}</span>
                    </div>

                    @if($pub->url)
                    <div style="margin-top: 0.5rem;">
                        <a href="{{ $pub->url }}" target="_blank" style="font-size: 0.9rem; font-weight: 600; color: {{ $pc }}; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                            View Source <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @empty
                <div style="background: #f8fafc; padding: 2rem; border-radius: 8px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No publications listed yet.</p>
                </div>
                @endforelse
            </div>
        </section>

        {{-- ═══════════ DEPARTMENT NEWS ═══════════ --}}
        <section id="news" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.1)); color: #d97706; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Department News</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #f59e0b, #d97706); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.8rem;">
                @forelse($news as $article)
                <div style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); transition: transform 0.3s, box-shadow 0.3s;"
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 20px 40px -10px rgba(0,0,0,0.08)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.02)'">
                    
                    <div style="position: relative; overflow: hidden;">
                        @if($article->featured_image)
                        <img src="{{ asset('storage/'.$article->featured_image) }}" alt="" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                        <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 3rem;">
                            <i class="fa-regular fa-image"></i>
                        </div>
                        @endif
                        <span style="position: absolute; top: 1rem; left: 1rem; background: rgba(0,0,0,0.7); color: white; backdrop-filter: blur(4px); padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">{{ $article->category }}</span>
                    </div>

                    <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                        <h3 style="margin: 0 0 1rem; font-size: 1.25rem; font-family: var(--font-heading); line-height: 1.4;">
                            <a href="{{ route('research-news.show', $article->slug) }}" style="color: #1e293b; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='#1e293b'">{{ $article->title }}</a>
                        </h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem; flex: 1;">{{ Str::limit(strip_tags($article->body), 110) }}</p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 1rem; margin-top: auto;">
                            <span style="font-size: 0.85rem; color: #94a3b8; font-weight: 500;">
                                <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> 
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : $article->created_at->format('M d, Y') }}
                            </span>
                            <a href="{{ route('research-news.show', $article->slug) }}" style="font-size: 0.85rem; font-weight: 600; color: var(--color-primary); text-decoration: none;">Read More <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem; margin-left: 2px;"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; background: #f8fafc; padding: 2.5rem; border-radius: 12px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No news articles published yet.</p>
                </div>
                @endforelse
            </div>
        </section>

        {{-- ═══════════ EVENTS CALENDAR ═══════════ --}}
        <section id="events" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1)); color: #ef4444; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Upcoming Events</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ef4444, #dc2626); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-events-list" style="display: flex; flex-direction: column; gap: 1.2rem;">
                @forelse($events as $event)
                <div class="blog-event-card" style="display: flex; background: white; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; align-items: stretch; flex-wrap: wrap;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px -8px rgba(0,0,0,0.08)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    
                    <!-- Date Box -->
                    <div class="blog-event-date" style="background: linear-gradient(135deg, var(--color-primary), #047857); color: white; padding: 1.5rem 2rem; text-align: center; display: flex; flex-direction: column; justify-content: center; min-width: 120px;">
                        <span style="font-size: 1rem; text-transform: uppercase; font-weight: 600; letter-spacing: 1px; color: #a7f3d0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span style="font-size: 2.8rem; font-weight: 800; line-height: 1; margin: 0.2rem 0; font-family: var(--font-heading);">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span style="font-size: 0.9rem; color: rgba(255,255,255,0.8);">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                    </div>

                    <!-- Details Box -->
                    <div class="blog-event-details" style="padding: 1.5rem 1.8rem; flex: 1; min-width: 250px;">
                        <h3 style="margin: 0 0 0.5rem; font-size: 1.3rem; color: #1e293b; font-family: var(--font-heading);">{{ $event->title }}</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1rem;">{{ $event->description }}</p>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 1.2rem; color: #475569; font-size: 0.9rem; font-weight: 500;">
                            <span style="display: flex; align-items: center; gap: 0.4rem; background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 8px;">
                                <i class="fa-regular fa-clock" style="color: var(--color-primary);"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}
                            </span>
                            @if($event->venue)
                            <span style="display: flex; align-items: center; gap: 0.4rem; background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 8px;">
                                <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i> {{ $event->venue }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="background: #f8fafc; padding: 2.5rem; border-radius: 12px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <div style="width: 48px; height: 48px; background: #e2e8f0; color: #94a3b8; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1rem;">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <p style="margin: 0;">No upcoming events scheduled.</p>
                </div>
                @endforelse
            </div>
        </section>
        
        {{-- ═══════════ PHOTO GALLERY ═══════════ --}}
        <section id="gallery" style="margin-bottom: 2rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(219, 39, 119, 0.1)); color: #db2777; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-images"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Photo Gallery</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ec4899, #db2777); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.2rem;">
                @forelse($albums as $album)
                <div style="position: relative; border-radius: 12px; overflow: hidden; height: 220px; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.05);"
                     onmouseover="this.querySelector('img').style.transform='scale(1.1)'; this.querySelector('.overlay-content').style.transform='translateY(0)'; this.querySelector('.overlay-content').style.opacity='1'"
                     onmouseout="this.querySelector('img').style.transform='scale(1)'; this.querySelector('.overlay-content').style.transform='translateY(10px)'; this.querySelector('.overlay-content').style.opacity='0.8'">
                     
                    <img src="{{ $album->cover_image ? asset('storage/'.$album->cover_image) : asset('build/assets/placeholder.jpg') }}" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);" onerror="this.src='https://via.placeholder.com/300?text={{ urlencode($album->title) }}'">
                    
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 50%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem 1.2rem;">
                        <h4 style="margin: 0 0 0.3rem; font-size: 1.1rem; color: white; line-height: 1.3; font-family: var(--font-heading);">{{ $album->title }}</h4>
                        
                        <div class="overlay-content" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #cbd5e1; opacity: 0.8; transform: translateY(10px); transition: all 0.3s;">
                            <span><i class="fa-regular fa-calendar-days" style="margin-right: 4px;"></i> {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('M Y') : 'Department Album' }}</span>
                            <div style="width: 28px; height: 28px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem; transform: rotate(-45deg);"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; background: #f8fafc; padding: 2.5rem; text-align: center; border-radius: 12px; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No albums available.</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>

    <x-sticky-toc :sections="[
        'research-areas' => 'Core Research Areas', 
        'publications' => 'Publications', 
        'news' => 'Department News', 
        'events' => 'Events Calendar', 
        'gallery' => 'Photo Gallery'
    ]" />
</div>

<style>
    /* ── Blog / Research-News Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .blog-hero h1 { font-size: 2.6rem !important; }
        .blog-main { padding: 2.5rem 2.5rem !important; }
        .blog-research-grid { grid-template-columns: 1fr !important; }
        .blog-news-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .blog-hero { padding: 3.5rem 0 4.5rem !important; }
        .blog-hero h1 { font-size: 2rem !important; }
        .blog-hero p { font-size: 1rem !important; }
        .blog-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .blog-main section { margin-bottom: 2.5rem !important; }
        .blog-section-heading h2 { font-size: 1.5rem !important; }
        .blog-section-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .blog-research-grid { grid-template-columns: 1fr !important; gap: 1rem !important; }
        .blog-research-grid > div { padding: 1.5rem 1.2rem !important; }
        .blog-pub-list > div { padding: 1.2rem !important; }
        .blog-pub-list > div h4 { font-size: 1rem !important; }
        .blog-pub-list > div > div:last-of-type { flex-direction: column !important; gap: 0.5rem !important; }
        .blog-news-grid { grid-template-columns: 1fr !important; gap: 1.2rem !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 180px !important; }
        .blog-event-card { flex-direction: column !important; }
        .blog-event-date { flex-direction: row !important; justify-content: center !important; gap: 0.6rem !important; align-items: center !important; padding: 1rem !important; min-width: unset !important; }
        .blog-event-date > span { font-size: 1rem !important; margin: 0 !important; }
        .blog-event-date > span:nth-child(2) { font-size: 1.8rem !important; }
        .blog-event-details { padding: 1.2rem !important; min-width: 0 !important; }
        .blog-event-details h3 { font-size: 1.1rem !important; }
        .blog-gallery-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .blog-gallery-grid > div { height: 180px !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .blog-hero { padding: 2.5rem 0 3.5rem !important; }
        .blog-hero h1 { font-size: 1.6rem !important; }
        .blog-hero p { font-size: 0.88rem !important; }
        .blog-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .blog-section-heading h2 { font-size: 1.3rem !important; }
        .blog-research-grid > div { padding: 1.2rem 1rem !important; }
        .blog-research-grid > div div[style*="width: 56px"] { width: 44px !important; height: 44px !important; font-size: 1.2rem !important; }
        .blog-research-grid > div h3 { font-size: 1.1rem !important; }
        .blog-research-grid > div p { font-size: 0.88rem !important; }
        .blog-pub-list > div { padding: 1rem !important; border-left-width: 3px !important; }
        .blog-pub-list > div h4 { font-size: 0.95rem !important; }
        .blog-pub-list > div > div:first-child { flex-direction: column !important; align-items: flex-start !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 160px !important; }
        .blog-news-grid > div h3 { font-size: 1.1rem !important; }
        .blog-news-grid > div p { font-size: 0.88rem !important; }
        .blog-event-date > span:nth-child(2) { font-size: 1.5rem !important; }
        .blog-event-details { padding: 1rem !important; }
        .blog-event-details h3 { font-size: 1rem !important; }
        .blog-event-details p { font-size: 0.88rem !important; }
        .blog-event-details > div { gap: 0.6rem !important; }
        .blog-event-details > div > span { font-size: 0.8rem !important; padding: 0.3rem 0.6rem !important; }
        .blog-gallery-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.6rem !important; }
        .blog-gallery-grid > div { height: 150px !important; }
        .blog-gallery-grid > div h4 { font-size: 0.95rem !important; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .blog-hero h1 { font-size: 1.35rem !important; }
        .blog-research-grid > div { padding: 1rem 0.8rem !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 140px !important; }
        .blog-gallery-grid { grid-template-columns: 1fr 1fr !important; }
        .blog-gallery-grid > div { height: 130px !important; }
        .blog-pub-list > div > div:last-of-type span { font-size: 0.8rem !important; }
    }
</style>
@endsection
