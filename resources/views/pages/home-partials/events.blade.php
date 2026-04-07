<!-- UPCOMING EVENTS -->
<section data-aos="fade-up" style="padding: 6rem 0; background-color: #FFFFFF; position: relative;">
    <div class="container" data-aos="fade-up">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
            <div>
                <span style="display: inline-block; color: #ef4444; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem; background: rgba(239,68,68,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_events_badge','Mark Your Calendar') }}</span>
                <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_events_title','Upcoming Events') }}</h2>
            </div>
            <a href="{{ url('/events') }}" style="background: white; color: #ef4444; padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.background='#ef4444'; this.style.color='white'; this.style.borderColor='#ef4444'" onmouseout="this.style.background='white'; this.style.color='#ef4444'; this.style.borderColor='#e2e8f0'">
                {{ $gs('home_events_btn_text','All Events') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.2rem;">
            @forelse($events as $event)
            <div class="event-card" style="display: flex; gap: 1.5rem; padding: 1.2rem; background: #f8fafc; border-radius: 16px; text-decoration: none; align-items: center; border: 1px solid #e2e8f0; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.02)'">
                <div style="width: 80px; height: 80px; flex-shrink: 0; background: white; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 2px solid #ef4444; overflow: hidden;">
                    <span style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: white; line-height: 1; background: #ef4444; width: 100%; text-align: center; padding: 0.2rem 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                    <span style="font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1.1; margin-top: 0.4rem; padding-bottom: 0.2rem; font-family: var(--font-heading);">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                </div>
                <div style="flex: 1;">
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 0.4rem; font-family: var(--font-heading);">{{ $event->title }}</h3>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                        <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="fa-regular fa-clock" style="color: #ef4444;"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                        @if($event->venue)
                        <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-location-dot" style="color: #ef4444;"></i> {{ $event->venue }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="padding: 3rem; text-align: center; background: #f8fafc; border-radius: 12px; border: 1px dashed #e2e8f0;">
                <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-regular fa-calendar-xmark"></i></div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: #0f172a;">No upcoming events</h3>
                <p style="color: #64748b; margin: 0;">We will publish new events here soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
