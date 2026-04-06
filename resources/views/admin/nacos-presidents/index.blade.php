@extends($adminLayout ?? 'layouts.admin')
@section('title', 'NACOS Presidents')
@section('header', 'NACOS Presidents')

@section('content')
<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-user-graduate" style="color: var(--color-primary); opacity: 0.8;"></i> 
            NACOS Presidents History
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-list-ol" style="font-size: 0.8rem;"></i>
            Manage former and current NACOS (National Association of Computing Students) Presidents.
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
        <a href="{{ route('admin.bulk-import.show', 'nacos-presidents') }}" class="modern-header-btn" style="background: white; color: #334155; border: 1px solid #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;" title="Import Presidents from CSV">
            <i class="fa-solid fa-file-import"></i> Bulk Add
        </a>
        <a href="{{ route('admin.nacos-presidents.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add President
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #065f46; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #a7f3d0; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.1em;"></i> {{ session('success') }}
</div>
@endif

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
    .staff-contact-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.2rem;
    }
    .staff-contact-item i {
        width: 14px;
        text-align: center;
        color: #94a3b8;
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
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }
</style>

<div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); overflow-x: auto;">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 1%;">S/N</th>
                <th>President Profile</th>
                <th>Tenure Duration</th>
                <th>Status</th>
                <th style="text-align: center; width: 1%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presidents as $i => $p)
            <tr>
                <td style="color: #94a3b8; font-weight: 600; text-align: center; font-variant-numeric: tabular-nums;">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <div style="display: flex; align-items: flex-start; gap: 1rem; min-width: 250px;">
                        <div style="position: relative;">
                            @if($p->photo)
                                <img src="{{ asset('storage/'.$p->photo) }}" 
                                     style="width: 52px; height: 52px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);" 
                                     alt="{{ $p->name }}">
                            @else
                                <div style="width: 52px; height: 52px; border-radius: 10px; background: #f8fafc; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; color: #94a3b8; font-size: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                            @endif
                            @if(!$p->tenure_end)
                                <span style="position: absolute; -top: 5px; -right: 5px; background: #3b82f6; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; border: 2px solid white; box-shadow: 0 1px 2px rgba(0,0,0,0.1);" title="Active President">
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            @endif
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <strong style="font-size: 1.05rem; color: #0f172a;">{{ $p->name }}</strong>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="staff-contact-item" style="color: #334155; font-weight: 500; font-size: 0.95rem;">
                        <i class="fa-regular fa-calendar-days"></i> 
                        {{ $p->tenure_start ?? 'Unknown' }} — {{ $p->tenure_end ?? 'Present' }}
                    </div>
                </td>
                <td>
                    @if(!$p->tenure_end)
                        <span class="role-badge active">
                            Active President
                        </span>
                    @else
                        <span class="role-badge" title="{{ $p->current_status }}">
                            {{ $p->current_status ? Str::limit($p->current_status, 25) : 'Past President' }}
                        </span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.nacos-presidents.edit', $p) }}" class="action-icon-btn btn-edit" title="Edit Record">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.nacos-presidents.destroy', $p) }}" method="POST" style="margin: 0;" data-confirm="Are you sure you want to remove {{ $p->name }} from the list?">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-icon-btn btn-delete" title="Delete Record">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div style="padding: 4rem 2rem; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                            <i class="fa-solid fa-user-graduate" style="font-size: 2.5rem; color: #94a3b8;"></i>
                        </div>
                        <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No NACOS Presidents Found</h3>
                        <p style="margin: 0 0 1.5rem 0; color: #64748b; font-size: 0.95rem;">Start building the chronological leadership timeline for NACOS.</p>
                        <a href="{{ route('admin.nacos-presidents.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
                            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add First President
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
