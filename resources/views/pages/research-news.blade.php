@extends('layouts.public')
@section('title', 'Research & News')

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">Research, News & Events</h1>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg);">
    <div class="main-content">
        <section id="research-areas" style="margin-bottom: var(--spacing-xl);">
            <h2>Core Research Areas</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--spacing-md);">
                <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--color-primary);">
                    <h3 style="margin-top: 0;"><i class="fa-solid fa-brain" style="color: var(--color-accent); margin-right: 10px;"></i> Artificial Intelligence</h3>
                    <p style="margin-bottom: 0; font-size: 0.95rem;">Machine learning, natural language processing, and computer vision pushing the boundaries of autonomous systems.</p>
                </div>
                <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--color-secondary);">
                    <h3 style="margin-top: 0;"><i class="fa-solid fa-shield-halved" style="color: var(--color-accent); margin-right: 10px;"></i> Cybersecurity</h3>
                    <p style="margin-bottom: 0; font-size: 0.95rem;">Cryptography, network security, and robust threat detection for an increasingly connected world.</p>
                </div>
                <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--color-accent);">
                    <h3 style="margin-top: 0;"><i class="fa-solid fa-database" style="color: var(--color-primary); margin-right: 10px;"></i> Data Science</h3>
                    <p style="margin-bottom: 0; font-size: 0.95rem;">Big data analytics, data mining, and statistical modeling applied to health, agriculture, and finance.</p>
                </div>
            </div>
        </section>

        <section id="publications" style="margin-bottom: var(--spacing-xl);">
            <h2>Recent Publications</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($publications as $pub)
                <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--color-secondary);">
                    <h4 style="margin-top: 0; margin-bottom: 0.5rem; font-size: 1.1rem; line-height: 1.4;">{{ $pub->title }}</h4>
                    <p style="font-size: 0.95rem; color: var(--color-text-muted); margin-bottom: 0.8rem;">
                        <strong>{{ $pub->staff ? $pub->staff->name : 'Department Researcher' }}</strong> &mdash; 
                        <em>{{ $pub->journal }}</em> ({{ $pub->year }}) <span style="display: inline-block; background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem; margin-left: 5px; text-transform: uppercase;">{{ $pub->type }}</span>
                    </p>
                    @if($pub->url)
                    <a href="{{ $pub->url }}" target="_blank" style="font-size: 0.85rem; font-weight: 600; color: var(--color-primary);"><i class="fa-solid fa-external-link"></i> Read Publication</a>
                    @endif
                </div>
                @empty
                <p>No publications listed yet.</p>
                @endforelse
            </div>
        </section>

        <section id="news" style="margin-bottom: var(--spacing-xl);">
            <h2>Department News</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--spacing-md);">
                @forelse($news as $article)
                <div style="background: var(--color-bg-main); border: 1px solid var(--color-border); border-radius: 8px; overflow: hidden; display: flex; flex-direction: column;">
                    @if($article->featured_image)
                    <img src="{{ asset('storage/'.$article->featured_image) }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                    <div style="width: 100%; height: 200px; background: var(--color-bg-alt); display: flex; align-items: center; justify-content: center; color: var(--color-text-muted); font-size: 3rem;">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    @endif
                    <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                        <span style="font-size: 0.8rem; color: var(--color-secondary); text-transform: uppercase; font-weight: 600; letter-spacing: 1px; margin-bottom: 0.5rem;">{{ $article->category }}</span>
                        <h3 style="margin-top: 0; margin-bottom: 1rem;"><a href="#" style="color: var(--color-primary);">{{ $article->title }}</a></h3>
                        <p style="color: var(--color-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">{{ Str::limit(strip_tags($article->body), 120) }}</p>
                        <span style="font-size: 0.85rem; color: var(--color-text-muted); border-top: 1px solid var(--color-border); padding-top: 1rem;"><i class="fa-regular fa-calendar"></i> {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1;"><p>No news articles available.</p></div>
                @endforelse
            </div>
        </section>

        <section id="events" style="margin-bottom: var(--spacing-xl);">
            <h2>Events Calendar</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="background: var(--color-bg-alt); border-radius: 8px; border: 1px solid var(--color-border);">
                @forelse($events as $event)
                <div style="display: flex; gap: 1.5rem; padding: 1.5rem; border-bottom: 1px solid var(--color-border); align-items: center; flex-wrap: wrap;">
                    <div style="text-align: center; min-width: 80px; background: var(--color-primary); color: white; border-radius: 8px; padding: 10px;">
                        <span style="display: block; font-size: 0.9rem; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span style="display: block; font-size: 2rem; font-weight: 700; line-height: 1; margin: 4px 0;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span style="display: block; font-size: 0.8rem; color: var(--color-accent);">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <h3 style="margin-top: 0; margin-bottom: 0.5rem; color: var(--color-primary);">{{ $event->title }}</h3>
                        <p style="color: var(--color-text-main); font-size: 0.95rem; margin-bottom: 0.8rem;">{{ $event->description }}</p>
                        <div style="display: flex; gap: 1rem; color: var(--color-text-muted); font-size: 0.85rem;">
                            <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                            @if($event->venue)
                            <span><i class="fa-solid fa-location-dot"></i> {{ $event->venue }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="padding: 2rem; text-align: center;"><p>No upcoming events.</p></div>
                @endforelse
            </div>
        </section>
        
        <section id="gallery" style="margin-bottom: var(--spacing-xl);">
            <h2>Photo Gallery</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: var(--spacing-md);">
                @forelse($albums as $album)
                <div style="position: relative; border-radius: 8px; overflow: hidden; height: 200px; cursor: pointer; group;">
                    <img src="{{ $album->cover_image ? asset('storage/'.$album->cover_image) : asset('build/assets/placeholder.jpg') }}" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" onerror="this.src='https://via.placeholder.com/300?text={{ urlencode($album->title) }}'">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 2rem 1rem 1rem 1rem; color: white;">
                        <h4 style="margin: 0; font-size: 1rem;">{{ $album->title }}</h4>
                        <span style="font-size: 0.8rem; color: #ddd;">{{ $album->date ? \Carbon\Carbon::parse($album->date)->format('M Y') : '' }}</span>
                    </div>
                </div>
                @empty
                <p>No albums available.</p>
                @endforelse
            </div>
        </section>
    </div>

    <x-sticky-toc :sections="['research-areas' => 'Core Research Areas', 'publications' => 'Publications', 'news' => 'Department News', 'events' => 'Events Calendar', 'gallery' => 'Photo Gallery']" />
</div>
@endsection
