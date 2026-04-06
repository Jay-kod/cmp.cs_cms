@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Partners')

@section('header', 'Industry Partners')

@section('content')
<style>
    .modern-create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        opacity: 0.95;
    }
    .modern-header-btn:hover {
        background: #f8fafc !important;
        border-color: #94a3b8 !important;
        transform: translateY(-1px);
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
</style>

<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-handshake-angle" style="color: var(--color-primary); opacity: 0.8;"></i> 
            Industry Partners
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-list-ol" style="font-size: 0.8rem;"></i>
            Manage the department's academic and industry partnerships.
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
        <a href="{{ route('admin.partners.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add Partner
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #065f46; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #a7f3d0; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.1em;"></i> {{ session('success') }}
</div>
@endif

<div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); overflow-x: auto;">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 1%;">S/N</th>
                <th>Partner Logo & Name</th>
                <th>Website URL</th>
                <th>Order</th>
                <th>Status</th>
                <th style="text-align: center; width: 1%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $i => $partner)
            <tr>
                <td style="color: #94a3b8; font-weight: 600; text-align: center; font-variant-numeric: tabular-nums;">
                    {{ $partners->firstItem() + $i }}
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 1rem; min-width: 250px;">
                        <div style="width: 60px; height: 40px; background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            @if($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <i class="fa-solid fa-image" style="color: #cbd5e1; font-size: 1.2rem;"></i>
                            @endif
                        </div>
                        <strong style="font-size: 1.05rem; color: #0f172a;">{{ $partner->name }}</strong>
                    </div>
                </td>
                <td>
                    @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8em; color: #94a3b8;"></i> 
                            {{ Str::limit(str_replace(['http://', 'https://'], '', $partner->url), 35) }}
                        </a>
                    @else
                        <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 500;">
                            <i class="fa-solid fa-link-slash"></i> No URL
                        </span>
                    @endif
                </td>
                <td>
                    <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #f8fafc; color: #475569; padding: 0.2rem 0.6rem; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 0.85rem; font-weight: 600; font-variant-numeric: tabular-nums;">
                        <i class="fa-solid fa-arrow-down-short-wide" style="color: #94a3b8; font-size: 0.8em;"></i> {{ $partner->sort_order }}
                    </span>
                </td>
                <td>
                    @if($partner->is_active)
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
                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="action-icon-btn btn-edit" title="Edit Partner">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" style="margin: 0;" data-confirm="Are you sure you want to permanently delete {{ $partner->name }}?">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-icon-btn btn-delete" title="Delete Partner">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div style="padding: 4rem 2rem; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                            <i class="fa-solid fa-handshake-angle" style="font-size: 2.5rem; color: #94a3b8;"></i>
                        </div>
                        <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No Partners Added Yet</h3>
                        <p style="margin: 0 0 1.5rem 0; color: #64748b; font-size: 0.95rem;">Start showcasing your department's industry relationships and collaborations.</p>
                        <a href="{{ route('admin.partners.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
                            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add First Partner
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $partners->links() }}
</div>
@endsection
