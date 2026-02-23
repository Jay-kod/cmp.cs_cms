@extends('layouts.admin')
@section('title', 'Manage Pages')
@section('header', 'Static Pages')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Pages</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage legal and informational pages (Privacy Policy, Terms, Sitemap, etc.)</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add New Page</a>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #f87171; font-size: 0.9rem;">
    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
</div>
@endif

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Page Title</th>
                <th>Slug (URL)</th>
                <th>Type</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $pg)
            <tr>
                <td>
                    @if($pg->icon)<i class="{{ $pg->icon }}" style="color: var(--color-primary); margin-right: 0.3rem;"></i>@endif
                    <strong>{{ $pg->title }}</strong>
                </td>
                <td><code style="background: #f3f4f6; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">/page/{{ $pg->slug }}</code></td>
                <td>
                    @if($pg->is_system)
                        <span style="background: #dbeafe; color: #1e40af; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600;"><i class="fa-solid fa-lock" style="font-size: 0.65rem;"></i> System</span>
                    @else
                        <span style="background: #f3f4f6; color: #6b7280; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">Custom</span>
                    @endif
                </td>
                <td>
                    @if($pg->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td style="font-size: 0.82rem; color: #6b7280;">{{ $pg->updated_at->format('M j, Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="/page/{{ $pg->slug }}" target="_blank" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #f0fdf4; color: #166534; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-eye"></i> View</a>
                        <a href="{{ route('admin.pages.edit', $pg) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        @if(!$pg->is_system)
                        <form action="{{ route('admin.pages.destroy', $pg) }}" method="POST" data-confirm="Delete this page permanently?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-file-lines" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Pages Found</h3>
                        <p style="margin: 0; color: #64748b;">No pages found.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($pages->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $pages->links() }}
    </div>
    @endif
</div>
@endsection
