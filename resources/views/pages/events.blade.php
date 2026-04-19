@extends('layouts.public')
@section('title', 'Events')

@section('content')
{{-- Hero --}}
<section data-aos="fade-up" class="bg-gradient-to-br from-slate-900 to-slate-800 py-10 sm:py-16 text-white text-center flex flex-col items-center justify-center">
    <div class="container flex flex-col items-center" data-aos="fade-up">
        <span class="inline-block bg-green-600/20 text-[color:var(--color-primary)] py-[0.35rem] px-4 rounded-full text-[0.85rem] font-semibold mb-4 border border-green-600/30">
            <i class="fa-solid fa-calendar-days"></i> Department Events
        </span>
        <h1 class="font-heading text-[1.35rem] sm:text-[1.6rem] md:text-[2.5rem] font-bold m-0">Events Calendar</h1>
        <p class="text-slate-400 text-[0.92rem] sm:text-[1.1rem] mt-2 max-w-[600px] mx-auto">Stay updated with departmental events, workshops, seminars, and celebrations.</p>
    </div>
</section>

{{-- Search / Filter Bar --}}
<section data-aos="fade-up" class="pt-8">
    <div class="container" data-aos="fade-up">
        <div id="events-search-bar" class="bg-white border border-slate-200 rounded-[14px] p-[0.8rem] px-4 sm:p-4 sm:px-6 flex flex-wrap gap-[0.6rem] sm:gap-[0.8rem] items-center shadow-[0_4px_16px_rgba(0,0,0,0.04)]">
            <div class="flex-1 min-w-0 sm:min-w-[200px] relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[0.85rem]"></i>
                <input type="text" id="event-search-input" placeholder="Search events by title or location..." class="w-full py-[0.6rem] pr-[0.8rem] pl-[2.2rem] border border-slate-200 rounded-lg text-[0.9rem] outline-none transition-colors duration-200 bg-slate-50 focus:border-[color:var(--color-primary)]">
            </div>
            <select id="event-time-filter" class="py-[0.6rem] px-4 border border-slate-200 rounded-lg text-[0.9rem] bg-slate-50 text-slate-700 cursor-pointer outline-none">
                <option value="all">All Events</option>
                <option value="upcoming">Upcoming Only</option>
                <option value="past">Past Only</option>
            </select>
            <span id="event-result-count" class="text-[0.8rem] text-slate-500 font-medium py-[0.4rem] px-[0.8rem] bg-slate-100 rounded-full whitespace-nowrap"></span>
        </div>
    </div>
</section>

{{-- Upcoming Events --}}
@if($upcoming->count())
<section data-aos="fade-up" id="upcoming-section" class="py-8 sm:py-12">
    <div class="container" data-aos="fade-up">
        <h2 class="font-heading text-[1.5rem] font-bold m-0 mb-6 flex items-center gap-[0.6rem]">
            <i class="fa-solid fa-clock text-[color:var(--color-primary)] text-[1.2rem]"></i> Upcoming Events
        </h2>
        <div id="upcoming-grid" class="grid grid-cols-1 sm:grid-cols-[repeat(auto-fill,minmax(340px,1fr))] gap-6">
            @foreach($upcoming as $event)
            <div data-aos="fade-up" class="event-card group bg-white border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 shadow-[0_2px_10px_rgba(0,0,0,0.03)] hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)]" data-type="upcoming" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? '') }}">
                <div class="flex gap-4 p-4 md:p-6">
                    {{-- Date badge --}}
                    <div class="min-w-[60px] text-center shrink-0">
                        <div class="bg-[color:var(--color-primary)] text-white text-[0.7rem] font-bold uppercase py-1 px-0 rounded-t-lg">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                        <div class="bg-slate-100 border border-slate-200 border-t-0 rounded-b-lg py-1.5 px-0 text-[1.5rem] font-extrabold text-slate-900">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                    </div>
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="m-0 mb-1.5 text-[1.05rem] font-bold text-slate-900">{{ $event->title }}</h3>
                        <div class="flex flex-wrap gap-[0.8rem] text-[0.85rem] text-slate-500">
                            <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->time ?? $event->date)->format('h:i A') }}</span>
                            @if($event->location)
                            <span><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
                            @endif
                        </div>
                        @if($event->description)
                        <p class="mt-[0.6rem] m-0 text-[0.9rem] text-slate-600 leading-[1.6]">{{ Str::limit(strip_tags($event->description), 120) }}</p>
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
<section data-aos="fade-up" id="past-section" class="py-8 sm:py-12 bg-slate-50">
    <div class="container" data-aos="fade-up">
        <h2 class="font-heading text-[1.5rem] font-bold m-0 mb-6 flex items-center gap-[0.6rem]">
            <i class="fa-solid fa-clock-rotate-left text-slate-500 text-[1.2rem]"></i> Past Events
        </h2>

        @if($past->count())
        <div id="past-grid" class="grid grid-cols-1 sm:grid-cols-[repeat(auto-fill,minmax(340px,1fr))] gap-[1.2rem]">
            @foreach($past as $event)
            <div data-aos="fade-up" class="event-card group bg-white border border-slate-200 rounded-xl p-[1.2rem] flex gap-4 items-start opacity-85 hover:opacity-100 transition-opacity" data-type="past" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? '') }}">
                <div class="min-w-[50px] text-center shrink-0">
                    <div class="bg-slate-500 text-white text-[0.65rem] font-bold uppercase py-[3px] px-0 rounded-t-md">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div class="bg-slate-100 border border-slate-200 border-t-0 rounded-b-md py-1 px-0 text-[1.2rem] font-bold text-slate-600">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="m-0 mb-1 text-[0.95rem] font-semibold text-slate-700">{{ $event->title }}</h4>
                    <span class="text-[0.8rem] text-slate-400">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}@if($event->location) · {{ $event->location }}@endif</span>
                </div>
            </div>
            @endforeach
        </div>

        @if($past->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $past->links() }}
        </div>
        @endif
        @else
        <p class="text-center text-slate-400 p-8">No past events recorded yet.</p>
        @endif
    </div>
</section>

<div id="no-results-msg" class="hidden text-center py-12 px-8">
    <i class="fa-solid fa-calendar-xmark text-[3rem] text-gray-300 mb-4 block"></i>
    <p class="text-slate-500 text-[1.1rem] m-0">No events match your search.</p>
</div>

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
