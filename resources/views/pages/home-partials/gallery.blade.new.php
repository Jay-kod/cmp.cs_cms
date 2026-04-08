<!-- GALLERY SHOWCASE -->
@if($galleryImages->count())
<section data-aos="fade-up" style="padding: 6rem 0; background: #0f172a; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(22,163,74,0.08) 0%, transparent 50%, rgba(22,163,74,0.05) 100%); pointer-events: none;"></div>
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 2;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="display: inline-block; color: #86efac; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(134,239,172,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_gallery_badge','Photo Gallery') }}</span>
                <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: white; margin: 0;">{{ $gs('home_gallery_title','Department Life') }}</h2>
                <p style="color: #94a3b8; font-size: 1.05rem; margin-top: 0.5rem;">{{ $gs('home_gallery_subtitle','Moments from events, lectures, and campus life') }} — {{ $galleryAlbumCount }} {{ Str::plural('album', $galleryAlbumCount) }}.</p>
            </div>
            <a href="{{ route('gallery.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #86efac; font-weight: 700; text-decoration: none; font-size: 0.95rem; transition: gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">
                {{ $gs('home_gallery_btn_text','View All Photos') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <!-- Modern Masonry Gallery Layout -->
        <style>
            .home-gallery-masonry {
                column-count: 1;
                column-gap: 1.5rem;
                margin-top: 1.5rem;
            }
            @media (min-width: 640px) { .home-gallery-masonry { column-count: 2; } }
            @media (min-width: 1024px) { .home-gallery-masonry { column-count: 3; } }
            @media (min-width: 1280px) { .home-gallery-masonry { column-count: 4; } }
            
            .home-gallery-item {
                break-inside: avoid;
                margin-bottom: 1.5rem;
                position: relative;
                border-radius: 16px;
                overflow: hidden;
                background: #1e293b;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                cursor: pointer;
            }
            .home-gallery-item a {
                display: block;
                width: 100%;
                height: 100%;
            }
            .home-gallery-item img {
                width: 100%;
                height: auto;
                display: block;
                transition: transform 0.7s cubic-bezier(0.165, 0.84, 0.44, 1), filter 0.7s ease;
                filter: brightness(0.85);
            }
            .home-gallery-item:hover img {
                transform: scale(1.05);
                filter: brightness(1.05);
            }
            .home-gallery-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0,25,13,0.9) 0%, rgba(0,25,13,0.4) 40%, transparent 100%);
                opacity: 0;
                transition: opacity 0.4s ease;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 1.5rem;
                pointer-events: none;
            }
            .home-gallery-item:hover .home-gallery-overlay {
                opacity: 1;
            }
            .home-gallery-caption {
                color: #ffffff;
                font-size: 1.15rem;
                font-family: var(--font-heading);
                font-weight: 600;
                margin: 0;
                transform: translateY(15px);
                transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
            .home-gallery-item:hover .home-gallery-caption {
                transform: translateY(0);
            }
            .home-gallery-line {
                width: 40px;
                height: 3px;
                background: #00ea5d;
                border-radius: 2px;
                margin-top: 10px;
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) 0.1s;
            }
            .home-gallery-item:hover .home-gallery-line {
                transform: scaleX(1);
            }
        </style>
        
        <div class="home-gallery-masonry" data-aos="fade-up" data-aos-delay="100">
            @foreach($galleryImages as $index => $img)
            <div class="home-gallery-item group">
                <a href="{{ route('gallery.index') }}">
                    <img loading="lazy" src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? 'Gallery image' }}">
                    <div class="home-gallery-overlay">
                        <div>
                            @if($img->caption)
                            <h4 class="home-gallery-caption">{{ $img->caption }}</h4>
                            @endif
                            <div class="home-gallery-line"></div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif