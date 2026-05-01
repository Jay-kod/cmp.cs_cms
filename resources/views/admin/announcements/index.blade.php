@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Ticker')
@section('header', 'Ticker & Alerts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">All Ticker Items</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Manage important alerts, notices, and banners across the site.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        @php
            $prefix = request()->route()->getPrefix();
            $routePrefix = $prefix === '/super-admin' ? 'super-admin.' : 'admin.';
        @endphp
        <a href="{{ route($routePrefix . 'announcements.settings') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #f8fafc; color: #475569; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; border: 1px solid #cbd5e1; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); transition: background 0.2s;">
            <i class="fa-solid fa-cog"></i> Ticker Settings
        </a>
        <a href="{{ route($routePrefix . 'announcements.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); transition: background 0.2s;">
            <i class="fa-solid fa-plus"></i> New Announcement
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
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Notice Details</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Target Audience</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Priority</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $alert)
            @php
                $isExpired = $alert->expires_at && \Carbon\Carbon::parse($alert->expires_at)->isPast();
            @endphp
            <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s; opacity: {{ $isExpired ? '0.65' : '1' }};" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.2rem 1.5rem;">
                    <strong style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 0.3rem;">{{ $alert->title }}</strong>
                    <div style="font-size: 0.85rem; color: #64748b; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-regular fa-calendar" style="color: #94a3b8;"></i> Posted {{ $alert->created_at->format('M d, Y') }}
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #f1f5f9; color: #475569; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                        <i class="fa-solid fa-users" style="font-size: 0.75rem;"></i> {{ $alert->audience }}
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    @if($alert->priority === 'high')
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; color: #ef4444; font-size: 0.85rem; font-weight: 600;">
                            <i class="fa-solid fa-circle-exclamation"></i> High
                        </div>
                    @elseif($alert->priority === 'normal')
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; color: #0284c7; font-size: 0.85rem; font-weight: 600;">
                            <i class="fa-solid fa-circle-info"></i> Normal
                        </div>
                    @else
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem; font-weight: 600;">
                            <i class="fa-solid fa-circle-minus"></i> Low
                        </div>
                    @endif
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    @if($isExpired)
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #f1f5f9; color: #64748b; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                            <i class="fa-solid fa-clock-rotate-left" style="font-size: 0.75rem;"></i> Expired
                        </div>
                    @else
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #ecfdf5; color: #059669; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #a7f3d0;">
                            <div style="width: 6px; height: 6px; background: #10b981; border-radius: 50%; box-shadow: 0 0 4px #10b981;"></div> Broadcasting
                        </div>
                    @endif
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: right;">
                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                        <a href="{{ route('admin.announcements.edit', $alert) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #475569; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'" title="Edit Announcement">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.announcements.destroy', $alert) }}" method="POST" data-confirm="Are you sure you want to delete this announcement?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Announcement">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fa-solid fa-bullhorn" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                    <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No Active Announcements</h3>
                    <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">There are currently no alerts or notices being broadcasted.</p>
                    <a href="{{ route('admin.announcements.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
                        Draft Announcement
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($announcements->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e2e8f0; background: #fff;">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection
