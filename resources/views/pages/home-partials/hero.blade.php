<!-- HERO CAROUSEL — Dynamic from Database -->
<style>
    .hero-carousel .carousel-arrow {
        opacity: 0;
        transition: opacity 0.3s ease, background 0.3s ease;
    }
    .hero-carousel:hover .carousel-arrow {
        opacity: 1;
    }
</style>
<section data-aos="fade-up" class="hero-carousel" style="position: relative; overflow: hidden; height: 652px;">
    <!-- Slides -->
    <div class="carousel-track" id="carouselTrack" style="display: flex; height: 100%; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
        
        @forelse($carouselSlides as $slide)
        <div class="carousel-slide" style="min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative; {{ $slide->image_url ? "background: url('".$slide->image_url."') center/cover no-repeat;" : "background: linear-gradient(135deg, var(--color-primary) 0%, #1e293b 100%);" }}">
            <!-- Rich Gradient Overlay -->
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, {{ $slide->overlay_color ?? 'rgba(6, 78, 30, 0.7)' }}, rgba(6, 50, 20, 0.92));"></div>
            
            <!-- Animated decorative elements -->
            <div style="position: absolute; top: 15%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: 20%; right: 15%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%; pointer-events: none;"></div>
            
            <div class="container" data-aos="fade-up" style="position: relative; z-index: 10; max-width: 850px; padding: 0 1.5rem; text-align: center; margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); padding: 0.4rem 1.2rem; border-radius: 30px; font-size: 0.8rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: 1.5px; text-transform: uppercase; color: #a7f3d0; border: 1px solid rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-code" style="font-size: 0.7rem;"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 style="text-align: center; color: white; font-size: 3.8rem; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1.2rem; line-height: 1.1; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">{{ $slide->title }}</h1>
                @if($slide->subtitle)
                <p style="text-align: center; font-size: 1.15rem; color: #cbd5e1; margin: 0 auto 2.5rem; max-width: 700px; line-height: 1.7; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">{{ $slide->subtitle }}</p>
                @endif
                @if($slide->button_text)
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ $slide->button_url ?? '#' }}" class="btn" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: none; box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.4); display: inline-flex; align-items: center; gap: 0.6rem; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px -5px rgba(22, 163, 74, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px -5px rgba(22, 163, 74, 0.4)'">
                        {{ $slide->button_text }} <i class="fa-solid fa-arrow-right" style="font-size: 0.9rem;"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        {{-- Fallback if no slides in DB --}}
        <div class="carousel-slide" style="min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative; background: linear-gradient(135deg, var(--color-primary) 0%, #1e293b 100%);">
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.95));"></div>
            
            <div style="position: absolute; top: 15%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: 20%; right: 15%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%; pointer-events: none;"></div>
            
            <div class="container" data-aos="fade-up" style="position: relative; z-index: 10; max-width: 850px; padding: 0 1.5rem; text-align: center; margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); padding: 0.4rem 1.2rem; border-radius: 30px; font-size: 0.8rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: 1.5px; text-transform: uppercase; color: #a7f3d0; border: 1px solid rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-laptop-code" style="font-size: 0.7rem;"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 style="text-align: center; color: white; font-size: 3.8rem; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1.2rem; line-height: 1.1; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">Empowering the Future<br>of Computing</h1>
                <p style="text-align: center; font-size: 1.15rem; color: #cbd5e1; margin: 0 auto 2.5rem; max-width: 700px; line-height: 1.7; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ url('/about') }}" class="btn" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: none; box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.4); display: inline-flex; align-items: center; gap: 0.6rem; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px -5px rgba(22, 163, 74, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px -5px rgba(22, 163, 74, 0.4)'">
                        Explore Department <i class="fa-solid fa-arrow-right" style="font-size: 0.9rem;"></i>
                    </a>
                    <a href="{{ url('/academics') }}" class="btn" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); display: inline-flex; align-items: center; gap: 0.6rem; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                        View Programmes
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($carouselSlides->count() > 1)
    <!-- Navigation Arrows -->
    <button class="carousel-arrow" onclick="moveCarousel(-1)" style="position: absolute; left: 30px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2); color: white; width: 54px; height: 54px; border-radius: 50%; cursor: pointer; font-size: 1.3rem; z-index: 10; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="carousel-arrow" onclick="moveCarousel(1)" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2); color: white; width: 54px; height: 54px; border-radius: 50%; cursor: pointer; font-size: 1.3rem; z-index: 10; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'"><i class="fa-solid fa-chevron-right"></i></button>

    <!-- Dot Indicators -->
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 10;">
        @foreach($carouselSlides as $i => $dot)
        <button class="carousel-dot {{ $i === 0 ? 'active' : '' }}" onclick="goToSlide({{ $i }})" style="width: 14px; height: 14px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5); background: {{ $i === 0 ? 'white' : 'transparent' }}; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.borderColor='white'"></button>
        @endforeach
    </div>
    @endif
    
    <!-- Glassmorphism Announcements Ticker (Overlaps Hero Bottom) -->
    @if($announcements->count() > 0)
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; z-index: 20; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 2px solid var(--color-primary);">
          <div class="container" data-aos="fade-up" style="display: flex; align-items: center; gap: 1rem; padding: 0.6rem 1rem;">
              <div style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: #fff; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; white-space: nowrap; letter-spacing: 1px; box-shadow: 0 0 8px rgba(22, 163, 74, 0.8), inset 0 0 3px rgba(255, 255, 255, 0.2); display: flex; align-items: center; gap: 0.4rem; border: 1px solid rgba(255,255,255,0.2);">
                  <i class="fa-solid fa-bolt" style="font-size: 0.6rem;"></i> Notice
            </div>
            <div style="overflow: hidden; flex: 1;">
                <div class="announcement-scroll" style="display: flex; gap: 4rem; animation: scrollAnnouncements 20s linear infinite; white-space: nowrap; padding-left: 100%;">
                    @foreach($announcements as $announcement)
                    <span style="color: #cbd5e1; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.6rem;">
                        <strong style="color: white; font-weight: 600;">{{ $announcement->title }} <span style="color: #64748b; font-weight: 400; margin: 0 0.3rem;">&mdash;</span></strong> {{ Str::limit($announcement->body, 120) }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
