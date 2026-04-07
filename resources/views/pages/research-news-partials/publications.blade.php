        {{-- ═══════════ RECENT PUBLICATIONS ═══════════ --}}
        <section data-aos="fade-up" id="publications" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(14, 165, 233, 0.1)); color: #0891b2; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-book-journal-whills"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Recent Publications</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #0891b2, #0ea5e9); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-pub-list" style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($publications as $index => $pub)
                @php
                    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'];
                    $pc = $colors[$index % 4];
                @endphp
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; border-left: 4px solid {{ $pc }}; display: flex; flex-direction: column; gap: 0.8rem; transition: transform 0.2s, box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateX(6px)'; this.style.boxShadow='0 8px 20px -5px rgba(0,0,0,0.05)'"
                     onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                    
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">
                        <h4 style="margin: 0; font-size: 1.15rem; color: #1e293b; line-height: 1.5;">{{ $pub->title }}</h4>
                        <span style="background: {{ $pc }}15; color: {{ $pc }}; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; white-space: nowrap;">{{ $pub->type }}</span>
                    </div>
                    
                    <div style="font-size: 0.95rem; color: #64748b; display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
                        <span style="color: #334155; font-weight: 600;"><i class="fa-solid fa-user-pen" style="color: #94a3b8; margin-right: 4px;"></i> {{ $pub->staff ? $pub->staff->name : 'Department Researcher' }}</span>
                        <span><i class="fa-solid fa-book" style="color: #94a3b8; margin-right: 4px;"></i> <em>{{ $pub->journal }}</em></span>
                        <span style="background: #f1f5f9; padding: 0.1rem 0.5rem; border-radius: 4px; font-size: 0.85rem;"><i class="fa-regular fa-calendar" style="color: #94a3b8;"></i> {{ $pub->year }}</span>
                    </div>

                    @if($pub->url)
                    <div style="margin-top: 0.5rem;">
                        <a href="{{ $pub->url }}" target="_blank" style="font-size: 0.9rem; font-weight: 600; color: {{ $pc }}; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                            View Source <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @empty
                <div style="background: #f8fafc; padding: 2rem; border-radius: 8px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No publications listed yet.</p>
                </div>
                @endforelse
            </div>
        </section>
