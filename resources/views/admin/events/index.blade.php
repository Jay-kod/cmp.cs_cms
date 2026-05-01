@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Events')
@section('header', 'Department Events')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">All Events Dashboard</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Manage academic calendar, seminars, and social gatherings.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        <a href="{{ route('admin.events.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); transition: background 0.2s;">
            <i class="fa-solid fa-plus"></i> Create Event
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #047857; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
    <i class="fa-solid fa-check-circle" style="font-size: 1.1rem;"></i> {{ session('success') }}
</div>
@endif

<div data-aos="fade-up" class="admin-card" style="padding: 0; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 15%;">Event Date</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Event Title & Venue</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Engagement</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            @php
                $isUpcoming = \Carbon\Carbon::parse($event->date)->isFuture();
                $isPassed = \Carbon\Carbon::parse($event->end_date ?? $event->date)->isPast();
            @endphp
            <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.2rem 1.5rem;">
                    <div style="background: {{ $isUpcoming ? 'var(--color-primary)' : '#f1f5f9' }}; border-radius: 8px; text-align: center; overflow: hidden; width: 60px; border: 1px solid {{ $isUpcoming ? 'rgba(0,0,0,0.1)' : '#cbd5e1' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="background: {{ $isUpcoming ? '#ef4444' : '#94a3b8' }}; color: white; font-size: 0.65rem; font-weight: 700; padding: 3px 0; text-transform: uppercase; letter-spacing: 1px;">
                            {{ \Carbon\Carbon::parse($event->date)->format('M') }}
                        </div>
                        <div style="color: {{ $isUpcoming ? 'white' : '#64748b' }}; font-size: 1.3rem; font-weight: 700; padding: 6px 0;">
                            {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                        </div>
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        @if($event->flyer_image)
                            <img src="{{ asset('storage/'.$event->flyer_image) }}" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        @else
                            <div style="width: 70px; height: 70px; border-radius: 8px; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                <i class="fa-solid fa-camera" style="color: white; font-size: 1.2rem; opacity: 0.8;"></i>
                            </div>
                        @endif
                        <div style="flex: 1;">
                            <strong style="color: #0f172a; font-size: 1rem; display: block; margin-bottom: 0.3rem;">{{ $event->title }}</strong>
                            <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="fa-regular fa-clock" style="color: #94a3b8;"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}
                            </div>
                            @if($event->venue)
                                <div style="font-size: 0.85rem; color: #64748b; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-location-dot" style="color: #94a3b8;"></i> {{ Str::limit($event->venue, 50) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: center;">
                    <div style="display: flex; justify-content: center; gap: 0.8rem; font-size: 0.85rem; font-weight: 600; color: #475569;">
                        <span title="RSVPs" style="display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-users" style="color: #059669;"></i> {{ $event->rsvps_count }}</span>
                        <span title="Comments" style="display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-comments" style="color: #d97706;"></i> {{ $event->comments_count }}</span>
                        <span title="Reactions" style="display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-face-smile" style="color: #3b82f6;"></i> {{ $event->reactions_count }}</span>
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    @if($isUpcoming)
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #ecfdf5; color: #059669; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #a7f3d0;">
                            <div style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></div> Upcoming
                        </div>
                    @elseif($isPassed)
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #f1f5f9; color: #64748b; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                            <i class="fa-solid fa-check" style="font-size: 0.75rem;"></i> Completed
                        </div>
                    @else
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #fefce8; color: #ca8a04; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #fef08a;">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 0.75rem;"></i> Ongoing
                        </div>
                    @endif
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: right;">
                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                        <a href="{{ route('admin.events.show', $event) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f0fdf4; color: #16a34a; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#dcfce7'; this.style.color='#15803d'" title="View Insights">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.events.edit', $event) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #475569; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'" title="Edit Event">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" data-confirm="Are you sure you want to delete this event?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Event">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fa-regular fa-calendar-xmark" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                    <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No Events Scheduled</h3>
                    <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">Your academic calendar is currently empty.</p>
                    <a href="{{ route('admin.events.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
                        Create First Event
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($events->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e2e8f0; background: #fff;">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
