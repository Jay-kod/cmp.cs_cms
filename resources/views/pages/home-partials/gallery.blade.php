<!-- GALLERY SHOWCASE -->
@if($galleryImages->count())
<section style="padding: 6rem 0; background: #0f172a; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(22,163,74,0.08) 0%, transparent 50%, rgba(22,163,74,0.05) 100%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 2;">
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

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.8rem;">
            @foreach($galleryImages as $img)
            <div class="gallery-home-item" style="aspect-ratio: {{ $loop->first || $loop->index === 3 ? '1/1' : '4/3' }}; border-radius: 12px; overflow: hidden; position: relative; cursor: pointer; {{ $loop->first ? 'grid-row: span 2;' : '' }}">
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? '' }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 50%); opacity: 0; transition: opacity 0.3s; display: flex; align-items: flex-end; padding: 1rem;" class="gallery-overlay">
                    @if($img->caption)
                    <span style="color: white; font-size: 0.85rem; font-weight: 600;">{{ $img->caption }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
