<!-- HERO CAROUSEL — Dynamic from Database -->
<style>
    .hero-carousel .carousel-arrow {
        display: none !important;
    }
</style>
<section data-aos="fade-up" class="hero-carousel relative overflow-hidden min-h-[500px] h-[100vh]">
    <!-- Slides -->
    <div class="carousel-track flex h-full transition-transform duration-[600ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]" id="carouselTrack">
        
        @forelse($carouselSlides as $slide)
        <div class="carousel-slide min-w-full h-full flex items-center justify-center text-center text-white relative" style="{{ $slide->image_url ? "background: url('".$slide->image_url."') center/cover no-repeat;" : "background: linear-gradient(135deg, var(--color-primary) 0%, #1e293b 100%);" }}">
            <!-- Rich Gradient Overlay -->
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, {{ $slide->overlay_color ?? 'rgba(6, 78, 30, 0.7)' }}, rgba(6, 50, 20, 0.92));"></div>
            
            <!-- Animated decorative elements -->
            <div style="position: absolute; top: 15%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: 20%; right: 15%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%; pointer-events: none;"></div>
            
            <div class="container relative z-10 max-w-[850px] px-6 text-center mx-auto flex flex-col items-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm py-1.5 px-5 rounded-full text-[0.8rem] font-bold mb-6 tracking-[1.5px] uppercase text-emerald-200 border border-white/15">
                    <i class="fa-solid fa-code text-[0.7rem]"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 class="text-center text-white text-[3.8rem] font-heading font-extrabold mb-5 leading-[1.1] drop-shadow-[0_10px_30px_rgba(0,0,0,0.5)]">{{ $slide->title }}</h1>
                @if($slide->subtitle)
                <p class="text-center text-[1.15rem] text-slate-300 m-0 mx-auto mb-10 max-w-[700px] leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.3)]">{{ $slide->subtitle }}</p>
                @endif
                @if($slide->button_text)
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ $slide->button_url ?? '#' }}" class="group relative inline-flex items-center justify-center gap-3 bg-emerald-600 border border-emerald-500/30 text-white font-semibold text-[1.05rem] py-3.5 px-8 rounded-full shadow-[0_4px_20px_rgba(5,150,105,0.4)] transition-all duration-300 hover:bg-emerald-500 hover:shadow-[0_8px_30px_rgba(5,150,105,0.6)] hover:-translate-y-0.5 overflow-hidden">
                        {{ $slide->button_text }}
                        <i class="fa-solid fa-arrow-right text-[0.9rem] transition-transform duration-300 group-hover:translate-x-1.5"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        {{-- Fallback if no slides in DB --}}
        <div class="carousel-slide min-w-full h-full flex items-center justify-center text-center text-white relative bg-gradient-to-br from-primary to-slate-800">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 to-slate-900/95"></div>
            
            <div class="absolute top-[15%] left-[10%] w-[120px] h-[120px] border border-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[20%] right-[15%] w-[250px] h-[250px] border border-white/5 rounded-full pointer-events-none"></div>
            
            <div class="container relative z-10 max-w-[850px] px-6 text-center mx-auto flex flex-col items-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm py-1.5 px-5 rounded-full text-[0.8rem] font-bold mb-6 tracking-[1.5px] uppercase text-emerald-200 border border-white/15">
                    <i class="fa-solid fa-laptop-code text-[0.7rem]"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 class="text-center text-white text-[3.8rem] font-heading font-extrabold mb-5 leading-[1.1] drop-shadow-[0_10px_30px_rgba(0,0,0,0.5)]">Empowering the Future<br>of Computing</h1>
                <p class="text-center text-[1.15rem] text-slate-300 m-0 mx-auto mb-10 max-w-[700px] leading-[1.7] drop-shadow-[0_4px_10px_rgba(0,0,0,0.3)]">Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.</p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ url('/about') }}" class="group relative inline-flex items-center justify-center gap-3 bg-emerald-600 border border-emerald-500/30 text-white font-semibold text-[1.05rem] py-3.5 px-8 rounded-full shadow-[0_4px_20px_rgba(5,150,105,0.4)] transition-all duration-300 hover:bg-emerald-500 hover:shadow-[0_8px_30px_rgba(5,150,105,0.6)] hover:-translate-y-0.5 overflow-hidden">
                        Explore Department
                        <i class="fa-solid fa-arrow-right text-[0.9rem] transition-transform duration-300 group-hover:translate-x-1.5"></i>
                    </a>
                    <a href="{{ url('/academics') }}" class="inline-flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm text-white font-semibold py-3.5 px-8 text-[1.05rem] rounded-full border border-white/20 transition-all duration-300 hover:bg-white/20 hover:-translate-y-0.5">
                        View Programmes
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($carouselSlides->count() > 1)
    <!-- Navigation Arrows -->
    <button class="carousel-arrow absolute left-[30px] top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-sm border border-white/20 text-white w-[54px] h-[54px] rounded-full cursor-pointer text-[1.3rem] z-10 shadow-[0_4px_15px_rgba(0,0,0,0.1)] hover:bg-primary hover:border-primary transition-colors" onclick="moveCarousel(-1)"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="carousel-arrow absolute right-[30px] top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-sm border border-white/20 text-white w-[54px] h-[54px] rounded-full cursor-pointer text-[1.3rem] z-10 shadow-[0_4px_15px_rgba(0,0,0,0.1)] hover:bg-primary hover:border-primary transition-colors" onclick="moveCarousel(1)"><i class="fa-solid fa-chevron-right"></i></button>

    <!-- Dot Indicators -->
    <div class="absolute bottom-[30px] left-1/2 -translate-x-1/2 flex gap-3 z-10">
        @foreach($carouselSlides as $i => $dot)
        <button class="carousel-dot {{ $i === 0 ? 'active' : '' }} w-3.5 h-3.5 rounded-full border-2 border-white/50 cursor-pointer transition-all duration-300 hover:border-white {{ $i === 0 ? 'bg-white' : 'bg-transparent' }}" onclick="goToSlide({{ $i }})"></button>
        @endforeach
    </div>
    @endif
    
    <!-- Glassmorphism Announcements Ticker (Overlaps Hero Bottom) -->
    @if($announcements->count() > 0)
    @php
        $scrollSpeed = \App\Models\DepartmentSetting::getCached('announcement_scroll_speed', 10);
    @endphp
    <div class="absolute bottom-0 left-0 w-full z-20 bg-slate-900/60 backdrop-blur-md border-t border-white/10 border-b-2 border-primary">
          <div class="container flex items-center gap-4 py-2.5 px-4" data-aos="fade-up">
              <div class="bg-emerald-600 border border-emerald-500/40 text-white py-1 px-2.5 rounded text-[0.65rem] font-extrabold uppercase whitespace-nowrap tracking-[1px] shadow-[0_4px_10px_rgba(5,150,105,0.4)] flex items-center gap-1.5">
                  <i class="fa-solid fa-bolt text-[0.6rem]"></i> Notice
            </div>
            <div class="overflow-hidden flex-1">
                <div class="announcement-scroll flex gap-16 whitespace-nowrap pl-[100%]" style="animation: scrollAnnouncements {{ $scrollSpeed }}s linear infinite;">
                    @foreach($announcements as $announcement)
                    <span class="text-slate-300 text-[0.95rem] inline-flex items-center gap-2.5">
                        <strong class="text-white font-semibold">{{ $announcement->title }} <span class="text-slate-500 font-normal mx-1">&mdash;</span></strong> {{ Str::limit($announcement->body, 120) }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
