@extends('layouts.admin')
@section('title', 'Manage Announcements')
@section('header', 'Quick Announcements')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Announcements</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage important alerts, notices, and banners across the site.</p>
    </div>
    <a href="{{ route('admin.announcements.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> New Announcement</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Notice Details</th>
                <th>Target Audience</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $alert)
            @php
                $isExpired = $alert->expires_at && \Carbon\Carbon::parse($alert->expires_at)->isPast();
            @endphp
            <tr style="opacity: {{ $isExpired ? '0.6' : '1' }};">
                <td>
                    <strong style="display: block; color: var(--color-primary); margin-bottom: 4px;">{{ $alert->title }}</strong>
                    <div style="font-size: 0.8rem; color: #6b7280;">Posted {{ $alert->created_at->format('M d, Y') }}</div>
                </td>
                <td>
                    <span style="background: #e5e7eb; color: #374151; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;"><i class="fa-solid fa-users" style="width: 14px;"></i> {{ $alert->audience }}</span>
                </td>
                <td>
                    @if($alert->priority === 'high')
                        <span style="color: #ef4444; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-circle-exclamation"></i> High</span>
                    @elseif($alert->priority === 'normal')
                        <span style="color: #3b82f6; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-circle-info"></i> Normal</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-circle-minus"></i> Low</span>
                    @endif
                </td>
                <td>
                    @if($isExpired)
                        <span style="background: #f3f4f6; color: #6b7280; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;"><i class="fa-solid fa-clock-rotate-left"></i> Expired</span>
                    @else
                        <span style="background: #d1fae5; color: #059669; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;"><i class="fa-solid fa-satellite-dish"></i> Broadcasting</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.announcements.edit', $alert) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.announcements.destroy', $alert) }}" method="POST" data-confirm="Delete this announcement?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-bullhorn" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Announcements Active</h3>
                        <p style="margin: 0; color: #64748b;">No announcements active.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($announcements->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection
