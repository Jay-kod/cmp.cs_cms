        {{-- ----------- ANNOUNCEMENTS ----------- --}}
        <aside data-aos="fade-up" id="announcements" style="margin-bottom: 4rem; position: sticky; top: 120px;">
            <div style="background: white; border-radius: 16px; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1); padding: 1.5rem; border: 1px solid #f1f5f9;">
                <div class="blog-section-heading" style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div class="blog-section-icon" style="width: 36px; height: 36px; background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(185, 28, 28, 0.1)); color: #dc2626; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.3rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Announcements</h2>
                </div>
                
                <div class="announcements-grid" style="display: flex; flex-direction: column; gap: 1rem;">
                    @forelse($announcements as $announcement)
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 3px solid @if($announcement->priority == 'high') #ef4444 @else #3b82f6 @endif; border-radius: 8px; padding: 1rem; transition: transform 0.2s;" class="hover:shadow-sm">
                        <div style="margin-bottom: 0.5rem;">
                            <span style="display: inline-block; font-size: 0.65rem; padding: 0.15rem 0.5rem; border-radius: 12px; font-weight: 600; margin-bottom: 0.4rem; @if($announcement->priority == 'high') background: #fee2e2; color: #b91c1c; @else background: #dbeafe; color: #1d4ed8; @endif">
                                {{ ucfirst($announcement->audience) }}
                            </span>
                            <h3 style="margin: 0; font-size: 1rem; font-family: var(--font-heading); color: #1e293b; line-height: 1.3;">
                                {{ $announcement->title }}
                            </h3>
                        </div>
                        <div style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin-bottom: 0.6rem;">
                            {!! nl2br(e($announcement->body)) !!}
                        </div>
                        <div style="font-size: 0.75rem; color: #94a3b8; display: flex; align-items: center; gap: 0.3rem;">
                            <i class="fa-regular fa-clock"></i> 
                            {{ $announcement->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @empty
                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                        <p style="margin: 0; font-size: 0.9rem;">No active announcements.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </aside>
