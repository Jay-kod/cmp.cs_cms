<!-- LATEST NEWS -->
<section data-aos="fade-up" style="padding: 6rem 0; background-color: #F0F9F3; position: relative;">
    <div class="container" data-aos="fade-up">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
            <div>
                <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_news_badge','Stay Informed') }}</span>
                <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_news_title','Latest News') }}</h2>
            </div>
            <a href="{{ url('/research-news') }}" style="background: white; color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='white'; this.style.color='var(--color-primary)'; this.style.borderColor='#e2e8f0'">
                {{ $gs('home_news_btn_text','View All') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            @forelse($news as $item)
            <a href="{{ route('research-news.show', $item->slug) }}" class="news-card" style="display: flex; flex-direction: column; background: white; padding: 1.2rem; text-decoration: none; border-radius: 16px; border: 1px solid #e2e8f0; transition: transform 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.04);" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                @if($item->featured_image)
                <div style="width: 100%; height: 180px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #e2e8f0; position: relative; margin-bottom: 1rem;">
                    <img loading="lazy" decoding="async" src="{{ app(\App\Services\MediaOptimizationService::class)->webpOrOriginalUrl($item->featured_image, 640) }}" alt="" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s;" class="news-img">
                </div>
                @else
                <div style="width: 100%; height: 180px; flex-shrink: 0; border-radius: 12px; background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(99,102,241,0.1)); display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 2.5rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                @endif
                <div style="flex: 1; display: flex; flex-direction: column;">
                    <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.4rem; display: flex; align-items: center; gap: 0.4rem; font-weight: 600;">
                        <i class="fa-regular fa-calendar" style="color: var(--color-primary);"></i>
                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('M j, Y') : \Carbon\Carbon::parse($item->created_at)->format('M j, Y') }}
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 0.5rem; font-family: var(--font-heading); line-height: 1.4;">
                        {{ Str::limit($item->title, 65) }}
                    </h3>
                    @if($item->excerpt)
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0; line-height: 1.5;">{{ Str::limit($item->excerpt, 80) }}</p>
                    @endif
                </div>
            </a>
            @empty
            <div style="padding: 3rem; text-align: center; background: white; border-radius: 12px; border: 1px solid #e2e8f0; grid-column: 1 / -1;">
                <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-regular fa-newspaper"></i></div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: #0f172a;">No news currently</h3>
                <p style="color: #64748b; margin: 0;">Check back later for updates and announcements.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
