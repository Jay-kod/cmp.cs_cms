        {{-- ═══════════ DEPARTMENT NEWS ═══════════ --}}
        <section data-aos="fade-up" id="news" class="mb-16">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-[1.3rem] shadow-sm border border-green-100">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Department News</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-green-500 to-green-600 mb-8 rounded"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-10">
                @forelse($news as $article)
                <div class="group h-full">
                    <a href="{{ route('research-news.show', $article->slug) }}" class="block h-full bg-white rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 hover:shadow-[0_20px_40px_rgb(0,0,0,0.12)] hover:border-green-200 hover:-translate-y-2 transition-all duration-500 flex flex-col relative">
                        
                        <div class="h-56 relative overflow-hidden bg-slate-100 w-full">
                            @if($article->featured_image)
                            <img src="{{ asset('storage/'.$article->featured_image) }}" alt="" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center text-slate-300">
                                <i class="fa-regular fa-image text-5xl mb-2"></i>
                            </div>
                            @endif
                            <span class="absolute top-4 left-4 bg-black/70 text-white backdrop-blur-sm py-1.5 px-4 rounded-full text-xs uppercase font-bold tracking-wider shadow-md">{{ $article->category }}</span>
                            
                            {{-- Hover Overlay --}}
                            <div class="absolute inset-0 bg-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 mix-blend-overlay"></div>
                        </div>

                        <div class="p-4 sm:p-6 md:p-8 flex-1 flex flex-col bg-white">
                            <h3 class="text-xl font-bold text-slate-800 leading-tight mb-3 group-hover:text-green-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-slate-500 text-sm md:text-base leading-relaxed text-justify m-0 mb-6 flex-1 line-clamp-3">
                                {{ Str::limit(strip_tags($article->body), 110) }}
                            </p>
                            
                            <div class="flex justify-between items-center border-t border-slate-100 pt-6 mt-auto">
                                <span class="text-xs sm:text-sm text-slate-400 font-bold uppercase tracking-wide flex items-center">
                                    <i class="fa-regular fa-calendar mr-1.5 text-green-500"></i> 
                                    {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                </span>
                                <span class="text-sm font-bold text-green-600 group-hover:text-green-700 transition-colors flex items-center">
                                    Read More <i class="fa-solid fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-3xl shadow-sm border border-slate-100 p-12 text-center mt-4">
                    <div class="w-20 h-20 mx-auto bg-slate-50 text-slate-400 rounded-full flex items-center justify-center text-3xl mb-4">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">No News Yet</h3>
                    <p class="text-slate-500">No news articles have been published.</p>
                </div>
                @endforelse
            </div>
        </section>
