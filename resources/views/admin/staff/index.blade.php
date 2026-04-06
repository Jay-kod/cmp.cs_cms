@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Staff')
@section('header', 'Staff Directory')

@section('content')

{{-- Success message --}}
@if(session('success'))
<div style="background: #ecfdf5; color: #065f46; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.1em;"></i> {{ session('success') }}
</div>
@endif

{{-- Import row errors --}}
@if(session('import_errors') && count(session('import_errors')))
<div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
    <div style="display: flex; align-items: center; gap: 0.5rem; color: #b45309; font-weight: 700; margin-bottom: 0.75rem; font-size: 1.05rem;">
        <i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Some Rows Had Issues During Import
    </div>
    <ul style="margin: 0; padding: 0 0 0 1.5rem; color: #92400e; font-size: 0.9rem; list-style-type: disc; max-height: 200px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.25rem;">
        @foreach(session('import_errors') as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-users-rectangle" style="color: var(--color-primary); opacity: 0.8;"></i> 
            All Staff Members
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-sitemap" style="font-size: 0.8rem;"></i>
            Manage department personnel, ranks, and roles.
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
        <a href="{{ route('admin.staff-roles.index') }}" class="modern-header-btn" style="background: white; color: #6d28d9; border: 1px solid #ddd6fe; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;" title="Manage Staff Roles">
            <i class="fa-solid fa-id-badge"></i> Roles
        </a>
        <span class="modern-header-btn-disabled" style="background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; cursor: not-allowed; position: relative;" title="Coming in next version">
            <i class="fa-solid fa-file-import"></i> Bulk Add
            <span style="position: absolute; top: -8px; right: -8px; background: #eab308; color: white;     font-size: 0.6rem; padding: 0.15rem 0.4rem; border-radius: 999px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(234, 179, 8, 0.3);">V2</span>
        </span>
        <a href="{{ route('admin.staff.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
            <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add New
        </a>
    </div>
</div>

<style>
    .modern-create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        opacity: 0.95;
    }
    .modern-header-btn:hover {
        background: #faf5ff !important;
        border-color: #c4b5fd !important;
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
    .role-badge.hod {
        background: #fef3c7;
        color: #92400e;
        border-color: #fde68a;
    }
    .role-badge.leadership {
        background: #f3e8ff;
        color: #6d28d9;
        border-color: #e9d5ff;
    }
</style>

<div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); overflow-x: auto;">
    <table class="modern-table">
        <thead>
            <tr>
                <th style="width: 1%;">S/N</th>
                <th>Staff Profile</th>
                <th>Academic & Professional</th>
                <th>Status & Role</th>
                <th style="text-align: center; width: 1%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staff as $i => $person)
            <tr>
                <td style="color: #94a3b8; font-weight: 600; text-align: center; font-variant-numeric: tabular-nums;">
                    {{ $staff->firstItem() + $i }}
                </td>
                <td>
                    <div style="display: flex; align-items: flex-start; gap: 1rem; min-width: 280px;">
                        <div style="position: relative;">
                            <img src="{{ $person->photo ? asset('storage/'.$person->photo) : asset('build/assets/placeholder.jpg') }}" 
                                 style="width: 52px; height: 52px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);" 
                                 onerror="this.src='https://via.placeholder.com/52?text={{ urlencode(substr($person->name, 0, 1)) }}'">
                            @if($person->is_hod)
                                <span style="position: absolute; -top: 5px; -right: 5px; background: #f59e0b; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; border: 2px solid white; box-shadow: 0 1px 2px rgba(0,0,0,0.1);" title="Head of Department">
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            @endif
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <strong style="font-size: 1.05rem; color: #0f172a;">{{ $person->title }} {{ $person->name }}</strong>
                            </div>
                            @if($person->email)
                                <div class="staff-contact-item"><i class="fa-regular fa-envelope"></i> <a href="mailto:{{ $person->email }}" style="color: inherit; text-decoration: none;">{{ $person->email }}</a></div>
                            @endif
                            @if($person->phone)
                                <div class="staff-contact-item"><i class="fa-solid fa-phone"></i> {{ $person->phone }}</div>
                            @endif
                            @if($person->address)
                                <div class="staff-contact-item"><i class="fa-solid fa-location-dot"></i> {{ Str::limit($person->address, 35) }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div style="display: flex; flex-direction: column; gap: 0.4rem; min-width: 200px;">
                        @if($person->rank)
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <i class="fa-solid fa-award" style="color: #94a3b8; font-size: 0.85rem; margin-top: 0.2rem; width: 14px; text-align: center;"></i>
                                <span style="font-weight: 600; color: #334155; font-size: 0.9rem;">{{ $person->rank }}</span>
                            </div>
                        @endif
                        @if($person->qualifications)
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <i class="fa-solid fa-user-graduate" style="color: #94a3b8; font-size: 0.85rem; margin-top: 0.2rem; width: 14px; text-align: center;"></i>
                                <span style="font-size: 0.85rem; color: #475569; line-height: 1.4;">{{ $person->qualifications }}</span>
                            </div>
                        @endif
                        @if($person->specialisation)
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <i class="fa-solid fa-microscope" style="color: #94a3b8; font-size: 0.85rem; margin-top: 0.2rem; width: 14px; text-align: center;"></i>
                                <span style="font-size: 0.85rem; color: #64748b; line-height: 1.4; font-style: italic;">{{ Str::limit($person->specialisation, 45) }}</span>
                            </div>
                        @endif
                    </div>
                </td>
                <td style="white-space: nowrap;">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-start;">
                        @if($person->status === 'Tenure')
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #a7f3d0;"><i class="fa-solid fa-circle-check" style="font-size: 0.8em;"></i> Tenure</span>
                        @elseif($person->status === 'Visiting')
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #eff6ff; color: #2563eb; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #bfdbfe;"><i class="fa-solid fa-plane-arrival" style="font-size: 0.8em;"></i> Visiting</span>
                        @elseif($person->status === 'Sabbatical')
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #fff7ed; color: #d97706; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #fde68a;"><i class="fa-solid fa-clock" style="font-size: 0.8em;"></i> Sabbatical</span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #f1f5f9; color: #475569; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #e2e8f0;">{{ $person->status ?? 'Unspecified' }}</span>
                        @endif

                        @if($person->is_hod)
                            <span class="role-badge hod">Head of Department</span>
                        @endif
                        @if($person->role)
                            <span class="role-badge leadership">{{ $person->role }}</span>
                        @endif
                    </div>
                </td>
                <td style="text-align: center;">
                    <div style="display: flex; justify-content: center; gap: 0.5rem;">
                        <a href="{{ route('admin.staff.edit', $person) }}" class="action-icon-btn btn-edit" title="Edit Staff Profile">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.staff.destroy', $person) }}" method="POST" data-confirm="Are you sure you want to delete this staff member? This action cannot be undone." style="margin: 0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-icon-btn btn-delete" title="Delete Profile">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 4rem 2rem;">
                    <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                        <i class="fa-solid fa-user-slash" style="font-size: 2.5rem; color: #94a3b8;"></i>
                    </div>
                    <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No Staff Members Found</h3>
                    <p style="margin: 0; color: #64748b; font-size: 0.95rem;">You haven't added any staff or faculty members yet.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($staff->hasPages())
    <div style="margin-top: 1.5rem; background: white; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
        {{ $staff->links() }}
    </div>
@endif

@endsection
