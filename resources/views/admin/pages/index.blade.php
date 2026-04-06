@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Pages')
@section('header', 'Static Pages')

@section('content')
<style>
    .modern-create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        opacity: 0.95;
    }
    .action-icon-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
        color: #64748b;
        background: white;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    }
    .action-icon-btn:hover {
        transform: scale(1.05);
    }
    .btn-view:hover { background: #f0fdf4; color: #16a34a; border-color: #bbf7d0; }
    .btn-edit:hover { background: #eff6ff; color: #3b82f6; border-color: #bfdbfe; }
    .btn-delete:hover { background: #fef2f2; color: #ef4444; border-color: #fecaca; }
    
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
    }
    .modern-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .modern-table td {
        padding: 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }
    .modern-table tr:hover td {
        background: #f8fafc;
    }
    .modern-table tr:last-child td {
        border-bottom: none;
    }
    .role-badge {
        display: inline-flex;
        align-items: center;
        background: #f3f4f6;
        color: #4b5563;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid #e5e7eb;
        white-space: nowrap;
    }
    .role-badge.active {
        background: #ecfdf5;
        color: #059669;
        border-color: #a7f3d0;
    }
    .role-badge.hidden {
        background: #f1f5f9;
        color: #64748b;
        border-color: #e2e8f0;
    }
    .role-badge.system {
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }
</style>

<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-file-lines" style="color: var(--color-primary); opacity: 0.8;"></i> 
            All Pages
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-file-alt" style="font-size: 0.8rem;"></i>
            Manage legal and informational pages (Privacy Policy, Terms, etc.)
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
        <a href="{{ route('admin.pages.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add New Page
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #065f46; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #a7f3d0; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.1em;"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: #fef2f2; color: #991b1b; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #fecaca; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444; font-size: 1.1em;"></i> {{ session('error') }}
</div>
@endif

<div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); overflow-x: auto;">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 1%;">S/N</th>
                <th>Page Details</th>
                <th>Type</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th style="text-align: center; width: 1%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $pg)
            <tr>
                <td style="color: #94a3b8; font-weight: 600; text-align: center; font-variant-numeric: tabular-nums;">
                    {{ $pages->firstItem() + $loop->index }}
                </td>
                <td>
                    <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 220px;">
                        <strong style="font-size: 1.05rem; color: #0f172a; display: flex; align-items: center; gap: 0.5rem;">
                            @if($pg->icon)
                                <i class="{{ $pg->icon }}" style="color: var(--color-primary); font-size: 0.9em;"></i>
                            @else
                                <i class="fa-regular fa-file-lines" style="color: #94a3b8; font-size: 0.9em;"></i>
                            @endif
                            {{ $pg->title }}
                        </strong>
                        <div style="display: flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem;">
                            <i class="fa-solid fa-link" style="font-size: 0.8em; color: #94a3b8;"></i> 
                            <code style="background: #f1f5f9; padding: 0.1rem 0.4rem; border-radius: 4px; border: 1px solid #e2e8f0; color: #475569;">/page/{{ $pg->slug }}</code>
                        </div>
                    </div>
                </td>
                <td>
                    @if($pg->is_system)
                        <span class="role-badge system" title="System pages cannot be deleted">
                            <i class="fa-solid fa-lock" style="font-size: 0.7rem; margin-right: 0.3rem;"></i> System
                        </span>
                    @else
                        <span class="role-badge" title="Custom created page">
                            <i class="fa-solid fa-user-pen" style="font-size: 0.7rem; margin-right: 0.3rem; color: #94a3b8;"></i> Custom
                        </span>
                    @endif
                </td>
                <td>
                    @if($pg->is_active)
                        <span class="role-badge active">
                            <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50%; display: inline-block; margin-right: 0.3rem;"></span> Active
                        </span>
                    @else
                        <span class="role-badge hidden">
                            <span style="width: 6px; height: 6px; background: #94a3b8; border-radius: 50%; display: inline-block; margin-right: 0.3rem;"></span> Hidden
                        </span>
                    @endif
                </td>
                <td>
                    <div style="color: #475569; font-weight: 500; font-size: 0.9rem; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-regular fa-calendar" style="color: #94a3b8; font-size: 0.9em;"></i>
                        {{ $pg->updated_at->format('M j, Y') }}
                    </div>
                </td>
                <td>
                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ url('/page/' . $pg->slug) }}" target="_blank" class="action-icon-btn btn-view" title="View Live Page">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        <a href="{{ route('admin.pages.edit', $pg) }}" class="action-icon-btn btn-edit" title="Edit Page">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        @if(!$pg->is_system)
                        <form action="{{ route('admin.pages.destroy', $pg) }}" method="POST" style="margin: 0;" data-confirm="Are you sure you want to permanently delete '{{ $pg->title }}'?">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-icon-btn btn-delete" title="Delete Page">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div style="padding: 4rem 2rem; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                            <i class="fa-solid fa-file-lines" style="font-size: 2.5rem; color: #94a3b8;"></i>
                        </div>
                        <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No Pages Found</h3>
                        <p style="margin: 0 0 1.5rem 0; color: #64748b; font-size: 0.95rem;">Create informational and static pages for your site.</p>
                        <a href="{{ route('admin.pages.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
                            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add First Page
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($pages->hasPages())
<div style="margin-top: 1.5rem;">
    {{ $pages->links() }}
</div>
@endif
@endsection
