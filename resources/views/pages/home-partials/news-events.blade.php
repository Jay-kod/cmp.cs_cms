<!-- NEWS & EVENTS -->
<section style="padding: 6rem 0; background: white; position: relative;">
    <div class="container">
        <div class="news-events-split" style="display: grid; grid-template-columns: 1fr 400px; gap: 4rem; align-items: start;">
            
            <!-- News Column -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">
                    <div>
                        <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_news_badge','Stay Informed') }}</span>
                        <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_news_title','Latest News') }}</h2>
                    </div>
                    <a href="{{ url('/research-news') }}" style="background: white; color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='white'; this.style.color='var(--color-primary)'; this.style.borderColor='#e2e8f0'">
                        {{ $gs('home_news_btn_text','View All') }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @forelse($news as $item)
                    <a href="{{ route('research-news.show', $item->slug) }}" class="news-card" style="display: flex; gap: 1.5rem; padding: 1.2rem; text-decoration: none; border-radius: 16px; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        @if($item->featured_image)
                        <div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #e2e8f0; position: relative;">
                            <img src="{{ asset('storage/'.$item->featured_image) }}" alt="" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s;" class="news-img">
                        </div>
                        @else
                        <div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(99,102,241,0.1)); display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 2.5rem;">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        @endif
                        <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center;">
                            <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.5rem;">
                                <span style="font-size: 0.75rem; color: #0284c7; background: #e0f2fe; padding: 0.2rem 0.6rem; border-radius: 4px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">{{ $item->category }}</span>
                                <span style="font-size: 0.85rem; color: #94a3b8;"><i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ \Carbon\Carbon::parse($item->published_at)->format('M d, Y') }}</span>
                            </div>
                            <h3 style="font-size: 1.2rem; margin: 0 0 0.5rem 0; line-height: 1.4; color: #0f172a; font-family: var(--font-heading); font-weight: 700; transition: color 0.2s;" class="news-title">{{ $item->title }}</h3>
                            <p style="font-size: 0.95rem; color: #64748b; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ Str::limit(strip_tags($item->body), 120) }}</p>
                        </div>
                    </a>
                    @empty
                    <div style="text-align: center; padding: 4rem 2rem; background: #f8fafc; border-radius: 16px; color: #94a3b8; border: 1px dashed #cbd5e1;">
                        <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 1.1rem; color: #64748b;">No news articles available yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Events Sidebar -->
            <div>
                <div style="margin-bottom: 2.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">
                    <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem;">{{ $gs('home_events_badge','Calendar') }}</span>
                    <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_events_title','Upcoming Events') }}</h2>
                </div>
                
                <div style="background: #f8fafc; border-radius: 16px; padding: 2rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden;">
                    <!-- Top accent line -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));"></div>
                    
                    @forelse($events as $event)
                    <div style="display: flex; gap: 1.2rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;" class="event-item">
                        <div style="text-align: center; min-width: 65px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.4rem 0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; display: flex; flex-direction: column;">
                            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: white; background: var(--color-primary); padding: 0.2rem 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            <span style="display: block; font-size: 1.8rem; font-weight: 800; line-height: 1; margin-top: 0.4rem; color: #0f172a; font-family: var(--font-heading);">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-size: 1.1rem; margin: 0 0 0.4rem 0; color: #0f172a; font-weight: 700; font-family: var(--font-heading); line-height: 1.3;">{{ $event->title }}</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.3rem;">
                                <p style="font-size: 0.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-regular fa-clock" style="color: var(--color-primary);"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                                @if($event->venue)
                                <p style="font-size: 0.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-location-dot" style="color: var(--color-primary);"></i> {{ $event->venue }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 2rem 0; color: #94a3b8;">
                        <i class="fa-regular fa-calendar-xmark" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 1.05rem; color: #64748b;">No upcoming events scheduled.</p>
                    </div>
                    @endforelse
                    
                    <a href="{{ url('/research-news#events') }}" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-align: center; font-size: 0.95rem; font-weight: 700; color: var(--color-primary); padding-top: 0.5rem; text-decoration: none; transition: gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">
                        {{ $gs('home_events_btn_text','View Full Calendar') }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .marquee-wrapper {
        display: flex;
        overflow: hidden;
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }
    .marquee-content {
        display: flex;
        flex-shrink: 0;
        min-width: 100%;
        gap: 1.5rem;
        padding: 1rem 0;
        animation: scrollLeft 30s linear infinite;
    }
    .marquee-wrapper:hover .marquee-content {
        animation-play-state: paused;
    }
    .marquee-content.reverse {
        animation: scrollRight 30s linear infinite;
    }
    @keyframes scrollLeft {
        from { transform: translateX(0); }
        to { transform: translateX(calc(-100% - 1.5rem)); }
    }
    @keyframes scrollRight {
        from { transform: translateX(calc(-100% - 1.5rem)); }
        to { transform: translateX(0); }
    }
    .quick-link-card {
        width: 220px;
        flex-shrink: 0;
    }

    /* ── Discover More — Static Grid ── */
    .discover-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }
    .discover-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1.35rem 1.5rem;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(.4,0,.2,1);
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        overflow: hidden;
        animation: discoverFadeUp 0.5s ease both;
    }
    .discover-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        background: var(--card-color, var(--color-primary));
        border-radius: 16px 0 0 16px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .discover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .discover-card:hover::before { opacity: 1; }

    .discover-card__number {
        position: absolute;
        top: 0.6rem; right: 0.85rem;
        font-size: 0.7rem;
        font-weight: 700;
        color: #cbd5e1;
        font-family: var(--font-heading);
        letter-spacing: 0.5px;
        transition: color 0.3s;
    }
    .discover-card:hover .discover-card__number { color: var(--card-color); }

    .discover-card__icon {
        width: 48px; height: 48px;
        flex-shrink: 0;
        background: color-mix(in srgb, var(--card-color) 10%, transparent);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--card-color);
        font-size: 1.2rem;
        transition: all 0.35s;
    }
    .discover-card:hover .discover-card__icon {
        background: var(--card-color);
        color: white;
        transform: scale(1.08);
    }

    .discover-card__body { flex: 1; min-width: 0; }
    .discover-card__title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 0.15rem;
        font-family: var(--font-heading);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .discover-card__desc {
        font-size: 0.8rem;
        color: #94a3b8;
        margin: 0;
        line-height: 1.4;
    }

    .discover-card__arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px; height: 30px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    .discover-card:hover .discover-card__arrow {
        background: var(--card-color);
        color: white;
        transform: translateX(3px);
    }

    @keyframes discoverFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991px) {
        .discover-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 575px) {
        .discover-grid { grid-template-columns: 1fr; }
        .discover-card { padding: 1.1rem 1.2rem; }
    }
    .partner-card {
        height: 100px;
        min-width: 200px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 1.5rem;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        text-decoration: none;
    }
    .partner-logo {
        max-width: 140px;
        max-height: 55px;
        object-fit: contain;
        filter: grayscale(0%) opacity(1);
        transition: all 0.3s ease;
    }
    a.partner-card:hover, div.partner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.06);
        border-color: #cbd5e1;
    }
    a.partner-card:hover .partner-logo, div.partner-card:hover .partner-logo {  
        transform: scale(1.15);
    }
</style>
