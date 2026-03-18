@extends('layouts.public')
@section('title', 'Events')

@section('content')
{{-- Hero --}}
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 4rem 0; color: white; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
    <div class="container" style="display: flex; flex-direction: column; align-items: center;">
        <span style="display: inline-block; background: rgba(22,163,74,0.2); color: var(--color-primary); padding: 0.35rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 1rem; border: 1px solid rgba(22,163,74,0.3);">
            <i class="fa-solid fa-calendar-days"></i> Department Events
        </span>
        <h1 style="font-family: var(--font-heading); font-size: 2.5rem; font-weight: 700; margin: 0;">Events Calendar</h1>
        <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 0.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">Stay updated with departmental events, workshops, seminars, and celebrations.</p>
    </div>
</section>

{{-- Search / Filter Bar --}}
<section style="padding: 2rem 0 0;">
    <div class="container">
        <div id="events-search-bar" style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1rem 1.5rem; display: flex; flex-wrap: wrap; gap: 0.8rem; align-items: center; box-shadow: 0 4px 16px rgba(0,0,0,0.04);">
            <div style="flex: 1; min-width: 200px; position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
                <input type="text" id="event-search-input" placeholder="Search events by title or location..." style="width: 100%; padding: 0.6rem 0.8rem 0.6rem 2.2rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
            <select id="event-time-filter" style="padding: 0.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; background: #f8fafc; color: #334155; cursor: pointer; outline: none;">
                <option value="all">All Events</option>
                <option value="upcoming">Upcoming Only</option>
                <option value="past">Past Only</option>
            </select>
            <span id="event-result-count" style="font-size: 0.8rem; color: #64748b; font-weight: 500; padding: 0.4rem 0.8rem; background: #f1f5f9; border-radius: 20px; white-space: nowrap;"></span>
        </div>
    </div>
</section>

{{-- Upcoming Events --}}
@if($upcoming->count())
<section id="upcoming-section" style="padding: 3rem 0;">
    <div class="container">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; margin: 0 0 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-clock" style="color: var(--color-primary); font-size: 1.2rem;"></i> Upcoming Events
        </h2>
        <div id="upcoming-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem;">
            @foreach($upcoming as $event)
            <div class="event-card" data-type="upcoming" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? '') }}" style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0.3s; box-shadow: 0 2px 10px rgba(0,0,0,0.03);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.08)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
                <div style="display: flex; gap: 1rem; padding: 1.5rem;">
                    {{-- Date badge --}}
                    <div style="min-width: 60px; text-align: center; flex-shrink: 0;">
                        <div style="background: var(--color-primary); color: white; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; padding: 4px 0; border-radius: 8px 8px 0 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                        <div style="background: #f1f5f9; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 8px 8px; padding: 6px 0; font-size: 1.5rem; font-weight: 800; color: #0f172a;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                    </div>
                    {{-- Content --}}
                    <div style="flex: 1; min-width: 0;">
                        <h3 style="margin: 0 0 0.4rem; font-size: 1.05rem; font-weight: 700; color: #0f172a;">{{ $event->title }}</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.8rem; font-size: 0.85rem; color: #64748b;">
                            <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->time ?? $event->date)->format('h:i A') }}</span>
                            @if($event->location)
                            <span><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
                            @endif
                        </div>
                        @if($event->description)
                        <p style="margin: 0.6rem 0 0; font-size: 0.9rem; color: #475569; line-height: 1.6;">{{ Str::limit(strip_tags($event->description), 120) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Past Events --}}
<section id="past-section" style="padding: 3rem 0; background: #f8fafc;">
    <div class="container">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; margin: 0 0 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-clock-rotate-left" style="color: #64748b; font-size: 1.2rem;"></i> Past Events
        </h2>

        @if($past->count())
        <div id="past-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.2rem;">
            @foreach($past as $event)
            <div class="event-card" data-type="past" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? '') }}" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; display: flex; gap: 1rem; align-items: flex-start; opacity: 0.85;">
                <div style="min-width: 50px; text-align: center; flex-shrink: 0;">
                    <div style="background: #64748b; color: white; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; padding: 3px 0; border-radius: 6px 6px 0 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div style="background: #f1f5f9; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 6px 6px; padding: 4px 0; font-size: 1.2rem; font-weight: 700; color: #475569;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h4 style="margin: 0 0 0.2rem; font-size: 0.95rem; font-weight: 600; color: #334155;">{{ $event->title }}</h4>
                    <span style="font-size: 0.8rem; color: #94a3b8;">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}@if($event->location) · {{ $event->location }}@endif</span>
                </div>
            </div>
            @endforeach
        </div>

        @if($past->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $past->links() }}
        </div>
        @endif
        @else
        <p style="text-align: center; color: #94a3b8; padding: 2rem;">No past events recorded yet.</p>
        @endif
    </div>
</section>

<div id="no-results-msg" style="display: none; text-align: center; padding: 3rem 2rem;">
    <i class="fa-solid fa-calendar-xmark" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; display: block;"></i>
    <p style="color: #64748b; font-size: 1.1rem; margin: 0;">No events match your search.</p>
</div>

<style>
/* Events Page Responsive */
@media (max-width: 768px) {
    .event-card div[style*="padding: 1.5rem"] { padding: 1rem !important; }
}
@media (max-width: 575px) {
    section[style*="padding: 4rem"] { padding: 2.5rem 0 !important; }
    section[style*="padding: 4rem"] h1[style*="font-size: 2.5rem"] { font-size: 1.6rem !important; }
    section[style*="padding: 4rem"] p[style*="font-size: 1.1rem"] { font-size: 0.92rem !important; }
    #upcoming-grid, #past-grid { grid-template-columns: 1fr !important; }
    #events-search-bar { padding: 0.8rem 1rem !important; gap: 0.6rem !important; }
    #events-search-bar > div[style*="min-width: 200px"] { min-width: 0 !important; }
    section[style*="padding: 3rem"] { padding: 2rem 0 !important; }
}
@media (max-width: 480px) {
    section[style*="padding: 4rem"] h1[style*="font-size: 2.5rem"] { font-size: 1.35rem !important; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('event-search-input');
    const timeFilter = document.getElementById('event-time-filter');
    const countEl = document.getElementById('event-result-count');
    const cards = document.querySelectorAll('.event-card');
    const upcomingSection = document.getElementById('upcoming-section');
    const pastSection = document.getElementById('past-section');
    const noResults = document.getElementById('no-results-msg');

    function filterEvents() {
        const query = searchInput.value.toLowerCase().trim();
        const type = timeFilter.value;
        let visible = 0;
        let upcomingVisible = 0;
        let pastVisible = 0;

        cards.forEach(card => {
            const title = card.dataset.title || '';
            const location = card.dataset.location || '';
            const cardType = card.dataset.type;
            const matchText = !query || title.includes(query) || location.includes(query);
            const matchType = type === 'all' || cardType === type;
            const show = matchText && matchType;

            card.style.display = show ? '' : 'none';
            if (show) {
                visible++;
                if (cardType === 'upcoming') upcomingVisible++;
                if (cardType === 'past') pastVisible++;
            }
        });

        // Show/hide sections
        if (upcomingSection) upcomingSection.style.display = upcomingVisible > 0 ? '' : 'none';
        if (pastSection) pastSection.style.display = pastVisible > 0 ? '' : 'none';
        noResults.style.display = visible === 0 ? '' : 'none';

        const total = cards.length;
        countEl.textContent = query || type !== 'all'
            ? visible + ' of ' + total + ' event' + (total !== 1 ? 's' : '')
            : total + ' event' + (total !== 1 ? 's' : '');
    }

    searchInput.addEventListener('input', filterEvents);
    timeFilter.addEventListener('change', filterEvents);
    filterEvents();
});
</script>
@endsection
