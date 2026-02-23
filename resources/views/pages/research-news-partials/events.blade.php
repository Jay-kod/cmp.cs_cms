        {{-- ═══════════ EVENTS CALENDAR ═══════════ --}}
        <section id="events" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1)); color: #ef4444; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Upcoming Events</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ef4444, #dc2626); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-events-list" style="display: flex; flex-direction: column; gap: 1.2rem;">
                @forelse($events as $event)
                <div class="blog-event-card" style="display: flex; background: white; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; align-items: stretch; flex-wrap: wrap;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px -8px rgba(0,0,0,0.08)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    
                    <!-- Date Box -->
                    <div class="blog-event-date" style="background: linear-gradient(135deg, var(--color-primary), #047857); color: white; padding: 1.5rem 2rem; text-align: center; display: flex; flex-direction: column; justify-content: center; min-width: 120px;">
                        <span style="font-size: 1rem; text-transform: uppercase; font-weight: 600; letter-spacing: 1px; color: #a7f3d0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span style="font-size: 2.8rem; font-weight: 800; line-height: 1; margin: 0.2rem 0; font-family: var(--font-heading);">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span style="font-size: 0.9rem; color: rgba(255,255,255,0.8);">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                    </div>

                    <!-- Details Box -->
                    <div class="blog-event-details" style="padding: 1.5rem 1.8rem; flex: 1; min-width: 250px;">
                        <h3 style="margin: 0 0 0.5rem; font-size: 1.3rem; color: #1e293b; font-family: var(--font-heading);">{{ $event->title }}</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1rem;">{{ $event->description }}</p>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 1.2rem; color: #475569; font-size: 0.9rem; font-weight: 500;">
                            <span style="display: flex; align-items: center; gap: 0.4rem; background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 8px;">
                                <i class="fa-regular fa-clock" style="color: var(--color-primary);"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}
                            </span>
                            @if($event->venue)
                            <span style="display: flex; align-items: center; gap: 0.4rem; background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 8px;">
                                <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i> {{ $event->venue }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="background: #f8fafc; padding: 2.5rem; border-radius: 12px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                    <div style="width: 48px; height: 48px; background: #e2e8f0; color: #94a3b8; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1rem;">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <p style="margin: 0;">No upcoming events scheduled.</p>
                </div>
                @endforelse
            </div>
        </section>
