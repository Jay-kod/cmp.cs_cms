@extends('layouts.public')
@section('title', 'Events')

@section('content')
{{-- Hero --}}
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 4rem 0; color: white; text-align: center;">
    <div class="container">
        <span style="display: inline-block; background: rgba(22,163,74,0.2); color: var(--color-primary); padding: 0.35rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 1rem; border: 1px solid rgba(22,163,74,0.3);">
            <i class="fa-solid fa-calendar-days"></i> Department Events
        </span>
        <h1 style="font-family: var(--font-heading); font-size: 2.5rem; font-weight: 700; margin: 0;">Events Calendar</h1>
        <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 0.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">Stay updated with departmental events, workshops, seminars, and celebrations.</p>
    </div>
</section>

{{-- Upcoming Events --}}
@if($upcoming->count())
<section style="padding: 3rem 0;">
    <div class="container">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; margin: 0 0 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-clock" style="color: var(--color-primary); font-size: 1.2rem;"></i> Upcoming Events
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem;">
            @foreach($upcoming as $event)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0.3s; box-shadow: 0 2px 10px rgba(0,0,0,0.03);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.08)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.03)'">
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
<section style="padding: 3rem 0; background: #f8fafc;">
    <div class="container">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; margin: 0 0 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-clock-rotate-left" style="color: #64748b; font-size: 1.2rem;"></i> Past Events
        </h2>

        @if($past->count())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.2rem;">
            @foreach($past as $event)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; display: flex; gap: 1rem; align-items: flex-start; opacity: 0.85;">
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
@endsection
