<section style="padding: 6rem 0; background: #F0F9F3; position: relative;">
    <div class="container reveal reveal-up">
        <div class="section-heading" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Department Gallery</h2>
                </div>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); border-radius: 2px;"></div>
            </div>
            
            <a href="{{ route('gallery.index') }}?department={{ $deptPrefix }}" class="btn btn-outline-primary" style="border: 2px solid var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;">
                View Full Gallery <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @php
            $departmentAlbums = \App\Models\GalleryAlbum::where('department_code', $deptPrefix)
                ->latest()
                ->limit(4)
                ->get();
        @endphp

        @if($departmentAlbums->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                @foreach($departmentAlbums as $album)
                    <a href="{{ route('gallery.show', $album->id) }}" class="gallery-card" style="display: block; position: relative; border-radius: 12px; overflow: hidden; text-decoration: none; aspect-ratio: 4/3; group">
                        <img src="{{ $album->cover_image ? asset('storage/'.$album->cover_image) : asset('images/placeholder-gallery.jpg') }}" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, transparent 60%); z-index: 1;"></div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2; color: white;">
                            <h4 style="margin: 0 0 0.4rem; font-size: 1.1rem; font-weight: 700;">{{ Str::limit($album->title, 40) }}</h4>
                            <span style="font-size: 0.85rem; color: #cbd5e1; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="fa-solid fa-camera"></i> {{ $album->photos_count ?? 0 }} Photos
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 16px; border: 1px dashed #cbd5e1;">
                <i class="fa-solid fa-camera-retro" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                <h3 style="font-size: 1.2rem; color: #475569; margin: 0;">No gallery albums available.</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 0.5rem;">Memories will be added here soon.</p>
            </div>
        @endif
    </div>
</section>