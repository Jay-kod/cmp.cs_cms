@extends('layouts.admin')
@section('title', 'Manage Events')
@section('header', 'Department Events')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Events Dashboard</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage academic calendar, seminars, and social gatherings.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Create Event</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Event Date</th>
                <th>Event Title & Venue</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            @php
                $isUpcoming = \Carbon\Carbon::parse($event->date)->isFuture();
                $isPassed = \Carbon\Carbon::parse($event->end_date ?? $event->date)->isPast();
            @endphp
            <tr>
                <td style="width: 15%;">
                    <div style="background: {{ $isUpcoming ? 'var(--color-primary)' : '#e5e7eb' }}; border-radius: 8px; text-align: center; overflow: hidden; width: 60px; border: 1px solid #d1d5db;">
                        <div style="background: {{ $isUpcoming ? '#ef4444' : '#9ca3af' }}; color: white; font-size: 0.65rem; font-weight: bold; padding: 2px 0; text-transform: uppercase; letter-spacing: 1px;">
                            {{ \Carbon\Carbon::parse($event->date)->format('M') }}
                        </div>
                        <div style="color: {{ $isUpcoming ? 'white' : '#6b7280' }}; font-size: 1.2rem; font-weight: bold; padding: 5px 0;">
                            {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                        </div>
                    </div>
                </td>
                <td>
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        @if($event->flyer_image)
                            <img src="{{ asset('storage/'.$event->flyer_image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                        @endif
                        <div>
                            <strong style="color: var(--color-primary); font-size: 1.05rem; display: block; margin-bottom: 4px;">{{ $event->title }}</strong>
                            <div style="font-size: 0.8rem; color: #6b7280;">
                                <i class="fa-regular fa-clock" style="width: 16px;"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}
                            </div>
                            @if($event->venue)
                                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">
                                    <i class="fa-solid fa-location-dot" style="width: 16px;"></i> {{ Str::limit($event->venue, 50) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    @if($isUpcoming)
                        <span style="background: #d1fae5; color: #059669; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;"><i class="fa-regular fa-calendar-check"></i> Upcoming</span>
                    @elseif($isPassed)
                        <span style="background: #f3f4f6; color: #6b7280; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;"><i class="fa-solid fa-check"></i> Completed</span>
                    @else
                        <span style="background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;"><i class="fa-solid fa-spinner fa-spin"></i> Ongoing</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 2rem;">No events found in the database.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($events->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
