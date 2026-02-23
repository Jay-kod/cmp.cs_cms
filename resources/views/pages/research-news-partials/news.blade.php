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
