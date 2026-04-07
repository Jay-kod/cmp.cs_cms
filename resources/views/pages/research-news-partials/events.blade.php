        {{-- ═══════════ EVENTS CALENDAR ═══════════ --}}
        <section data-aos="fade-up" id="events" style="margin-bottom: 4rem;">
            <div class="blog-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="blog-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1)); color: #ef4444; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Upcoming Events</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ef4444, #dc2626); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <div class="blog-events-list" style="display: flex; flex-direction: column; gap: 1.2rem;">
                @forelse($events as $event)
                <div data-aos="fade-up" class="blog-event-card" style="display: flex; background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); align-items: stretch; flex-wrap: wrap;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 15px 30px -10px rgba(0,0,0,0.1)'; this.style.borderColor='#cbd5e1'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.03)'; this.style.borderColor='#e2e8f0'">
                    
                    <!-- Date Box -->
                    <div class="blog-event-date" style="background: linear-gradient(135deg, var(--color-primary), #047857); color: white; padding: 1.5rem 2rem; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; min-width: 140px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -10px; right: -15px; opacity: 0.1; font-size: 5.5rem;">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <span style="font-size: 1.15rem; text-transform: uppercase; font-weight: 700; letter-spacing: 1.5px; color: rgba(255,255,255,0.9); z-index: 1;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span style="font-size: 3.2rem; font-weight: 800; line-height: 1; margin: 0.3rem 0; font-family: var(--font-heading); z-index: 1;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span style="font-size: 1.05rem; color: rgba(255,255,255,0.8); font-weight: 600; z-index: 1;">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                    </div>

                    <!-- Details Box -->
                    <div class="blog-event-details" style="padding: 1.8rem 2rem; flex: 1; min-width: 250px; display: flex; flex-direction: column; justify-content: center;">
                        <h3 style="margin: 0 0 0.6rem; font-size: 1.35rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800; line-height: 1.35;">{{ $event->title }}</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.2rem;">{{ $event->description }}</p>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
                            <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: #f8fafc; border: 1px solid #e2e8f0; padding: 0.4rem 1rem 0.4rem 0.4rem; border-radius: 50px;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.04);">
                                    <i class="fa-solid fa-clock" style="color: #10b981; font-size: 0.85rem;"></i>
                                </div>
                                <span style="font-size: 0.9rem; font-weight: 600; color: #334155;">{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                            </div>
                            @if($event->venue)
                            <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: #f8fafc; border: 1px solid #e2e8f0; padding: 0.4rem 1rem 0.4rem 0.4rem; border-radius: 50px;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.04);">
                                    <i class="fa-solid fa-location-dot" style="color: #ef4444; font-size: 0.85rem;"></i>
                                </div>
                                <span style="font-size: 0.9rem; font-weight: 600; color: #334155;">{{ $event->venue }}</span>
                            </div>
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
