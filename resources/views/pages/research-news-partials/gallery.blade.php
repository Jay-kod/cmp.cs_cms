        {{-- ═══════════ PHOTO GALLERY ═══════════ --}}
        <section data-aos="fade-up" id="gallery" class="mb-8">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-gradient-to-br from-pink-500/15 to-pink-600/10 text-pink-600 rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-images"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Photo Gallery</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-pink-500 to-pink-600 mb-8 rounded"></div>
            
            <div class="blog-gallery-grid grid grid-cols-[repeat(auto-fill,minmax(220px,1fr))] gap-[1.2rem]">
                @forelse($albums as $album)
                @php
                    $coverUrl = $album->cover_image 
                        ? asset('storage/'.$album->cover_image) 
                        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : null);
                @endphp
                <a href="{{ route('gallery.show', $album->slug) }}" class="no-underline block relative rounded-xl overflow-hidden h-[220px] cursor-pointer shadow-[0_4px_10px_rgba(0,0,0,0.05)] group">
                     
                    @if($coverUrl)
                    <img src="{{ $coverUrl }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="hidden w-full h-full bg-gradient-to-br from-slate-800 to-slate-700 items-center justify-center text-slate-400 text-[2.5rem]">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-700 flex items-center justify-center text-slate-400 text-[2.5rem]">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent flex flex-col justify-end p-[1.5rem_1.2rem]">
                        <h4 class="m-0 mb-[0.3rem] text-[1.1rem] text-white leading-[1.3] font-heading">{{ $album->title }}</h4>
                        
                        <div class="overlay-content flex justify-between items-center text-[0.8rem] text-slate-300 opacity-80 translate-y-2.5 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                            <span><i class="fa-regular fa-calendar-days mr-1"></i> {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('M Y') : 'Department Album' }}</span>
                            <div class="w-7 h-7 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white">
                                <i class="fa-solid fa-arrow-right text-[0.7rem] -rotate-45"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full bg-slate-50 p-10 text-center rounded-xl text-slate-500 border border-dashed border-slate-300">
                    <p class="m-0">No albums available.</p>
                </div>
                @endforelse
            </div>
        </section>
