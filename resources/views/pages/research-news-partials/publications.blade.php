        {{-- ═══════════ RECENT PUBLICATIONS ═══════════ --}}
        <section data-aos="fade-up" id="publications" class="mb-16">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-gradient-to-br from-cyan-500/15 to-sky-500/10 text-cyan-600 rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-book-journal-whills"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Recent Publications</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-cyan-600 to-sky-500 mb-8 rounded"></div>
            
            <div class="blog-pub-list flex flex-col gap-4">
                @forelse($publications as $index => $pub)
                @php
                    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'];
                    $textColors = ['text-blue-500', 'text-emerald-500', 'text-amber-500', 'text-violet-500'];
                    $bgColors = ['bg-blue-500/10', 'bg-emerald-500/10', 'bg-amber-500/10', 'bg-violet-500/10'];
                    $pc = $colors[$index % 4];
                    $tc = $textColors[$index % 4];
                    $bc = $bgColors[$index % 4];
                @endphp
                <div class="bg-white p-6 rounded-xl border border-slate-200 border-l-[4px] flex flex-col gap-3 transition-all duration-200 hover:translate-x-1.5 hover:shadow-[0_8px_20px_-5px_rgba(0,0,0,0.05)] border-l-{{ str_replace('text-', '', $textColors[$index % 4]) }}">
                    <div class="flex justify-between items-start gap-4">
                        <h4 class="m-0 text-[1.15rem] text-slate-800 leading-relaxed">{{ $pub->title }}</h4>
                        <span class="{{ $bgColors[$index % 4] }} {{ $textColors[$index % 4] }} py-0.5 px-2.5 rounded-full text-[0.7rem] uppercase font-bold tracking-wider whitespace-nowrap">{{ $pub->type }}</span>
                    </div>
                    
                    <div class="text-[0.95rem] text-slate-500 flex flex-wrap gap-4 items-center">
                        <span class="text-slate-700 font-semibold"><i class="fa-solid fa-user-pen text-slate-400 mr-1"></i> {{ $pub->staff ? $pub->staff->name : 'Department Researcher' }}</span>
                        <span><i class="fa-solid fa-book text-slate-400 mr-1"></i> <em>{{ $pub->journal }}</em></span>
                        <span class="bg-slate-100 py-0.5 px-2 rounded text-[0.85rem]"><i class="fa-regular fa-calendar text-slate-400"></i> {{ $pub->year }}</span>
                    </div>

                    @if($pub->url)
                    <div class="mt-2">
                        <a href="{{ $pub->url }}" target="_blank" class="text-[0.9rem] font-semibold no-underline inline-flex items-center gap-1.5 {{ $tc }} hover:underline">
                            View Source <i class="fa-solid fa-arrow-up-right-from-square text-[0.75rem]"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @empty
                <div class="bg-slate-50 p-8 rounded-lg text-center text-slate-500 border border-dashed border-slate-300">
                    <p class="m-0">No publications listed yet.</p>
                </div>
                @endforelse
            </div>
        </section>
