        {{-- ═══════════ PHOTO GALLERY ═══════════ --}}
        <section id="gallery" style="margin-bottom: 2rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(219, 39, 119, 0.1)); color: #db2777; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-images"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Photo Gallery</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ec4899, #db2777); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.2rem;">
                @forelse($albums as $album)
                <div style="position: relative; border-radius: 12px; overflow: hidden; height: 220px; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.05);"
                     onmouseover="this.querySelector('img').style.transform='scale(1.1)'; this.querySelector('.overlay-content').style.transform='translateY(0)'; this.querySelector('.overlay-content').style.opacity='1'"
                     onmouseout="this.querySelector('img').style.transform='scale(1)'; this.querySelector('.overlay-content').style.transform='translateY(10px)'; this.querySelector('.overlay-content').style.opacity='0.8'">
                     
                    <img src="{{ $album->cover_image ? asset('storage/'.$album->cover_image) : asset('build/assets/placeholder.jpg') }}" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);" onerror="this.src='https://via.placeholder.com/300?text={{ urlencode($album->title) }}'">
                    
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 50%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem 1.2rem;">
                        <h4 style="margin: 0 0 0.3rem; font-size: 1.1rem; color: white; line-height: 1.3; font-family: var(--font-heading);">{{ $album->title }}</h4>
                        
                        <div class="overlay-content" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #cbd5e1; opacity: 0.8; transform: translateY(10px); transition: all 0.3s;">
                            <span><i class="fa-regular fa-calendar-days" style="margin-right: 4px;"></i> {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('M Y') : 'Department Album' }}</span>
                            <div style="width: 28px; height: 28px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem; transform: rotate(-45deg);"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; background: #f8fafc; padding: 2.5rem; text-align: center; border-radius: 12px; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No albums available.</p>
                </div>
                @endforelse
            </div>
        </section>
