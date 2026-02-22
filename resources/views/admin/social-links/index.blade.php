@extends('layouts.admin')
@section('title', 'Social Links')
@section('header', 'Social Links')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Social Media Links</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the social media icons displayed in the website footer</p>
    </div>
    <a href="{{ route('admin.social-links.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add Link</a>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- Preview --}}
<div class="admin-card" style="margin-bottom: 1.5rem; padding: 1.2rem;">
    <h4 style="margin: 0 0 0.8rem; font-size: 0.88rem; color: #6b7280; font-weight: 600;">Footer Preview</h4>
    <div style="display: flex; gap: 0.6rem; background: #111827; padding: 1rem 1.2rem; border-radius: 8px;">
        @forelse($links->where('is_active', true) as $social)
        <span style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: rgba(255,255,255,0.08); color: #9ca3af; font-size: 0.9rem;" title="{{ $social->name }}"><i class="{{ $social->icon }}"></i></span>
        @empty
        <span style="font-size: 0.85rem; color: #6b7280;">No active social links to preview.</span>
        @endforelse
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 50px;">Icon</th>
                <th>Platform</th>
                <th>URL</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($links as $link)
            <tr>
                <td style="color: #9ca3af; font-size: 0.82rem;">{{ $link->sort_order }}</td>
                <td>
                    <span style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f3f4f6; color: var(--color-primary); font-size: 1rem;"><i class="{{ $link->icon }}"></i></span>
                </td>
                <td><strong>{{ $link->name }}</strong></td>
                <td>
                    <code style="background: #f3f4f6; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.8rem; word-break: break-all;">{{ Str::limit($link->url, 45) }}</code>
                </td>
                <td>
                    @if($link->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.social-links.edit', $link) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" data-confirm="Delete this social link?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 2rem; color: #9ca3af;">
                    <i class="fa-solid fa-share-nodes" style="font-size: 1.5rem; display: block; margin-bottom: 0.5rem;"></i>
                    No social links added yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
