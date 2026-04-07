        {{-- ----------- ANNOUNCEMENTS ----------- --}}
        <section data-aos="fade-up" id="announcements" style="margin-bottom: 4rem; padding-top: 4rem; border-top: 1px solid #e2e8f0;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(185, 28, 28, 0.1)); color: #dc2626; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Announcements</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ef4444, #b91c1c); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="announcements-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
                @forelse($announcements as $announcement)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid @if($announcement->priority == 'high') #ef4444 @else #3b82f6 @endif; border-radius: 8px; padding: 1rem; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column;" class="hover:shadow-md hover:-translate-y-1">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <h3 style="margin: 0; font-size: 1rem; font-family: var(--font-heading); color: #1e293b; line-height: 1.3;">
                            {{ $announcement->title }}
                        </h3>
                        <span style="font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 12px; font-weight: 600; white-space: nowrap; @if($announcement->priority == 'high') background: #fee2e2; color: #b91c1c; @else background: #dbeafe; color: #1d4ed8; @endif">
                            {{ ucfirst($announcement->audience) }}
                        </span>
                    </div>
                    <div style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin-bottom: 0.8rem; flex-grow: 1;">
                        {!! nl2br(e($announcement->body)) !!}
                    </div>
                    <div style="font-size: 0.75rem; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem; margin-top: auto;">
                        <i class="fa-regular fa-clock"></i> 
                        Posted {{ $announcement->created_at->diffForHumans() }}
                    </div>
                </div>
                @empty
                <div style="background: #f8fafc; padding: 2.5rem; border-radius: 12px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <p style="margin: 0;">No active announcements at the moment.</p>
                </div>
                @endforelse
            </div>
        </section>
