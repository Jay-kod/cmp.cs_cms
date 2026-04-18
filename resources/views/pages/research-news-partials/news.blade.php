        {{-- ═══════════ DEPARTMENT NEWS ═══════════ --}}
        <section data-aos="fade-up" id="news" class="mb-16">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-gradient-to-br from-amber-500/15 to-amber-600/10 text-amber-600 rounded-xl flex items-center justify-center text-[1.3rem]">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Department News</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-amber-500 to-amber-600 mb-8 rounded"></div>
            
            <div class="blog-news-grid grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-[1.8rem]">
                @forelse($news as $article)
                <div class="bg-white border border-slate-200 rounded-[14px] overflow-hidden flex flex-col shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl group">
                    
                    <div class="relative overflow-hidden">
                        @if($article->featured_image)
                        <img src="{{ asset('storage/'.$article->featured_image) }}" alt="" class="w-full h-[200px] object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                        <div class="w-full h-[200px] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-400 text-5xl">
                            <i class="fa-regular fa-image"></i>
                        </div>
                        @endif
                        <span class="absolute top-4 left-4 bg-black/70 text-white backdrop-blur-sm py-1 px-3 rounded-full text-xs uppercase font-semibold tracking-wider">{{ $article->category }}</span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="m-0 mb-4 text-xl font-heading leading-snug">
                            <a href="{{ route('research-news.show', $article->slug) }}" class="text-slate-800 no-underline transition-colors duration-200 hover:text-[color:var(--color-primary)]">{{ $article->title }}</a>
                        </h3>
                        <p class="text-slate-500 text-[0.95rem] leading-relaxed m-0 mb-6 flex-1">{{ Str::limit(strip_tags($article->body), 110) }}</p>
                        
                        <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-auto">
                            <span class="text-[0.85rem] text-slate-400 font-medium">
                                <i class="fa-regular fa-calendar mr-1"></i> 
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : $article->created_at->format('M d, Y') }}
                            </span>
                            <a href="{{ route('research-news.show', $article->slug) }}" class="text-[0.85rem] font-semibold text-[color:var(--color-primary)] no-underline">Read More <i class="fa-solid fa-arrow-right text-[0.7rem] ml-0.5"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-slate-50 p-10 rounded-xl text-center text-slate-500 border border-dashed border-slate-300">
                    <p class="m-0">No news articles published yet.</p>
                </div>
                @endforelse
            </div>
        </section>
