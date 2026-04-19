<!-- NEWS & EVENTS -->
<section data-aos="fade-up" class="py-24 bg-white relative">
    <div class="container" data-aos="fade-up">
        <div class="news-events-split grid grid-cols-[1fr_400px] gap-16 items-start">
            
            <!-- News Column -->
            <div>
                <div class="flex justify-between items-end mb-10 border-b-2 border-slate-100 pb-4">
                    <div>
                        <span class="inline-block text-[color:var(--color-primary)] text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-2 bg-blue-500/10 py-[0.3rem] px-4 rounded-full">{{ $gs('home_news_badge','Stay Informed') }}</span>
                        <h2 class="m-0 text-[2.4rem] font-heading font-extrabold text-slate-900">{{ $gs('home_news_title','Latest News') }}</h2>
                    </div>
                    <a href="{{ url('/research-news') }}" class="btn-outline bg-white text-[color:var(--color-primary)] py-[0.6rem] px-[1.2rem] rounded-lg text-[0.9rem] font-semibold no-underline border border-slate-200 transition-all duration-200 inline-flex items-center gap-2 hover:bg-[color:var(--color-primary)] hover:text-white hover:border-[color:var(--color-primary)]">
                        {{ $gs('home_news_btn_text','View All') }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
                
                <div class="flex flex-col gap-6">
                    @forelse($news as $item)
                    <a href="{{ route('research-news.show', $item->slug) }}" class="news-card flex gap-6 p-[1.2rem] no-underline rounded-2xl transition-colors duration-200 hover:bg-slate-50">
                        @if($item->featured_image)
                        <div class="w-[140px] h-[120px] shrink-0 rounded-xl overflow-hidden bg-slate-200 relative">
                            <img src="{{ asset('storage/'.$item->featured_image) }}" alt="" class="news-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        @else
                        <div class="w-[140px] h-[120px] shrink-0 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-[color:var(--color-primary)] text-[2.5rem]">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                            <div class="flex items-center gap-[0.8rem] mb-2">
                                <span class="text-[0.75rem] text-sky-600 bg-sky-100 py-[0.2rem] px-[0.6rem] rounded uppercase font-bold tracking-[0.5px]">{{ $item->category }}</span>
                                <span class="text-[0.85rem] text-slate-400"><i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($item->published_at)->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-[1.2rem] m-0 mb-2 leading-[1.4] text-slate-900 font-heading font-bold transition-colors duration-200 news-title">{{ $item->title }}</h3>
                            <p class="text-[0.95rem] text-slate-500 m-0 leading-[1.6] line-clamp-2">{{ Str::limit(strip_tags($item->body), 120) }}</p>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-16 px-8 bg-slate-50 rounded-2xl text-slate-400 border border-dashed border-slate-300">
                        <i class="fa-solid fa-newspaper text-[2.5rem] mb-4 block text-slate-300"></i>
                        <p class="m-0 text-[1.1rem] text-slate-500">No news articles available yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Events Sidebar -->
            <div>
                <div class="mb-10 border-b-2 border-slate-100 pb-4">
                    <span class="inline-block text-[color:var(--color-primary)] text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-2">{{ $gs('home_events_badge','Calendar') }}</span>
                    <h2 class="m-0 text-[2.4rem] font-heading font-extrabold text-slate-900">{{ $gs('home_events_title','Upcoming Events') }}</h2>
                </div>
                
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 relative overflow-hidden">
                    <!-- Top accent line -->
                    <div class="absolute top-0 left-0 right-0 h-[5px] bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-secondary)]"></div>
                    
                    @forelse($events as $event)
                    <div data-aos="fade-up" class="event-item flex gap-[1.2rem] mb-6 pb-6 border-b border-slate-200">
                        <div class="text-center min-w-[65px] bg-white border border-slate-200 rounded-[10px] py-[0.4rem] px-0 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col">
                            <span class="block text-[0.75rem] uppercase font-bold text-white bg-[color:var(--color-primary)] py-[0.2rem] px-0">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            <span class="block text-[1.8rem] font-extrabold leading-none mt-1.5 text-slate-900 font-heading">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[1.1rem] m-0 mb-1.5 text-slate-900 font-bold font-heading leading-[1.3]">{{ $event->title }}</h4>
                            <div class="flex flex-col gap-1">
                                <p class="text-[0.85rem] text-slate-500 m-0 flex items-center gap-2"><i class="fa-regular fa-clock text-[color:var(--color-primary)]"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                                @if($event->venue)
                                <p class="text-[0.85rem] text-slate-500 m-0 flex items-center gap-2"><i class="fa-solid fa-location-dot text-[color:var(--color-primary)]"></i> {{ $event->venue }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 px-0 text-slate-400">
                        <i class="fa-regular fa-calendar-xmark text-[2.5rem] mb-4 block text-slate-300"></i>
                        <p class="m-0 text-[1.05rem] text-slate-500">No upcoming events scheduled.</p>
                    </div>
                    @endforelse
                    
                    <a href="{{ url('/research-news#events') }}" class="group flex items-center justify-center gap-2 text-center text-[0.95rem] font-bold text-[color:var(--color-primary)] pt-2 no-underline transition-all duration-200 hover:gap-[0.8rem]">
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
