<section data-aos="fade-up" style="padding: 6rem 0; background: #FFFFFF; position: relative;">
    <div class="container" data-aos="fade-up">
        <div class="section-heading" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Department News</h2>
                </div>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); border-radius: 2px;"></div>
            </div>
            
            <a href="{{ route('research-news') }}?type=news&department={{ $deptPrefix }}" class="btn btn-outline-primary" style="border: 2px solid var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;">
                More News <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @php
            $departmentNews = \App\Models\News::where('type', 'news')
                ->where('department_code', $deptPrefix)
                ->where('is_published', true)
                ->latest()
                ->limit(3)
                ->get();
        @endphp

        @if($departmentNews->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                @foreach($departmentNews as $news)
                    <div data-aos="fade-up" class="news-card" style="background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; flex-direction: column; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                        <div class="news-img" style="height: 200px; overflow: hidden; position: relative;">
                            <img src="{{ $news->image ? asset('storage/'.$news->image) : asset('images/placeholder-news.jpg') }}" alt="{{ $news->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 1rem; left: 1rem; background: var(--color-primary); color: white; padding: 0.3rem 0.8rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                {{ $news->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="news-content" style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 1rem; line-height: 1.4;">
                                <a href="{{ route('research-news.show', $news->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.2s;">{{ Str::limit($news->title, 60) }}</a>
                            </h3>
                            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">
                                {{ Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <a href="{{ route('research-news.show', $news->slug) }}" style="color: var(--color-primary); font-weight: 600; font-size: 0.95rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">
                                Read More <i class="fa-solid fa-arrow-right" style="font-size: 0.8rem;"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 4rem 2rem; background: #f8fafc; border-radius: 16px; border: 1px dashed #e2e8f0;">
                <i class="fa-regular fa-newspaper" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                <h3 style="font-size: 1.2rem; color: #475569; margin: 0;">No news updates found for this department.</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 0.5rem;">Check back later for the latest announcements.</p>
            </div>
        @endif
    </div>
</section>