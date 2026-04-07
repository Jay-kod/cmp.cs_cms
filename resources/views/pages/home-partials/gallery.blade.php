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

        <!-- Sharp Professional Grid Layout -->
        <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 4px; grid-auto-rows: 250px;">
            @foreach($galleryImages as $index => $img)
            @php
                // Create a professional looking dynamic grid layout
                $isLarge = false;
                $isTall = false;
                $isWide = false;
                
                // For a dynamic, sharp asymmetric grid up to 8 items
                if ($index === 0) $isLarge = true; // First item is focal point
                elseif ($index === 3 || $index === 6) $isWide = true; // Some wide items
                elseif ($index === 4) $isTall = true; // Some tall items
                
                $gridSpan = '';
                if ($isLarge) $gridSpan = 'grid-column: span 2; grid-row: span 2;';
                elseif ($isWide) $gridSpan = 'grid-column: span 2; grid-row: span 1;';
                elseif ($isTall) $gridSpan = 'grid-column: span 1; grid-row: span 2;';
                else $gridSpan = 'grid-column: span 1; grid-row: span 1;';
            @endphp
            <div class="gallery-home-item group" style="{{ $gridSpan }} border-radius: 2px; overflow: hidden; position: relative; cursor: pointer;">
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? 'Gallery image' }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); filter: brightness(0.95);">
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, transparent 100%); opacity: 0; transition: opacity 0.4s ease-in-out; display: flex; align-items: flex-end; padding: 1.5rem;" class="gallery-overlay">
                    <div>
                        @if($img->caption)
                        <h4 style="color: white; font-size: 1.1rem; font-weight: 500; font-family: var(--font-heading); margin: 0; transform: translateY(10px); transition: transform 0.4s ease-in-out;" class="gallery-caption">{{ $img->caption }}</h4>
                        @endif
                        <div style="width: 20px; height: 2px; background: #86efac; margin-top: 8px; transform: scaleX(0); transition: transform 0.4s ease-in-out; transform-origin: left;" class="gallery-line"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
