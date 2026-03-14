@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Staff')
@section('header', 'Staff Directory')

@section('content')

{{-- Success message --}}
@if(session('success'))
<div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
</div>
@endif

{{-- Import row errors --}}
@if(session('import_errors') && count(session('import_errors')))
<div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1rem;">
    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d97706; font-weight: 700; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-triangle-exclamation"></i> Some Rows Had Issues
    </div>
    <ul style="margin: 0; padding: 0 0 0 1.2rem; color: #92400e; font-size: 0.85rem; list-style-type: disc; max-height: 200px; overflow-y: auto;">
        @foreach(session('import_errors') as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Staff Members</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage department personnel, ranks, and roles.</p>
    </div>
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        <a href="{{ route('admin.staff-roles.index') }}" class="btn" style="background: white; color: #6d28d9; border: 1px solid #d8b4fe; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;" title="Manage Staff Roles">
            <i class="fa-solid fa-id-badge"></i> Manage Roles
        </a>
        <span class="btn" style="background: #f3f4f6; color: #9ca3af; border: 1px solid #e5e7eb; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem; cursor: not-allowed; position: relative;" title="Coming in next version">
            <i class="fa-solid fa-file-import"></i> Add in Bulk
            <span style="position: absolute; top: -8px; right: -10px; background: #f59e0b; color: white; font-size: 0.6rem; padding: 1px 6px; border-radius: 10px; font-weight: 700; text-transform: uppercase;">Next Version</span>
        </span>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;">
            <i class="fa-solid fa-plus"></i> Add New Staff
        </a>
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 50px;">S/N</th>
                <th>Name, Email, Address & Phone</th>
                <th>Rank</th>
                <th>Qualifications</th>
                <th>Area of Specialization</th>
                <th>Status</th>
                <th>Position / Responsibility</th>
                <th style="width: 90px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staff as $i => $person)
            <tr>
                <td style="color: #94a3b8; font-weight: 600;">{{ $staff->firstItem() + $i }}</td>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ $person->photo ? asset('storage/'.$person->photo) : asset('build/assets/placeholder.jpg') }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb;" onerror="this.src='https://via.placeholder.com/40?text=S'">
                        <div>
                            <strong style="display: block;">{{ $person->title }} {{ $person->name }}</strong>
                            @if($person->is_hod) <span style="background: var(--color-accent); color: var(--color-primary); padding: 2px 6px; border-radius: 10px; font-size: 0.65rem; font-weight: bold; text-transform: uppercase;">HOD</span> @endif
                            @if($person->email)<div style="font-size: 0.78rem; color: #6b7280;"><i class="fa-regular fa-envelope" style="width: 12px; font-size: 0.7rem;"></i> {{ $person->email }}</div>@endif
                            @if($person->address)<div style="font-size: 0.78rem; color: #6b7280;"><i class="fa-solid fa-location-dot" style="width: 12px; font-size: 0.7rem;"></i> {{ $person->address }}</div>@endif
                            @if($person->phone)<div style="font-size: 0.78rem; color: #6b7280;"><i class="fa-solid fa-phone" style="width: 12px; font-size: 0.65rem;"></i> {{ $person->phone }}</div>@endif
                        </div>
                    </div>
                </td>
                <td>{{ $person->rank ?? '—' }}</td>
                <td style="font-size: 0.85rem;">{{ $person->qualifications ?? '—' }}</td>
                <td style="font-size: 0.85rem;">{{ Str::limit($person->specialisation, 40) ?: '—' }}</td>
                <td>
                    @if($person->status === 'Tenure')
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Tenure</span>
                    @elseif($person->status === 'Visiting')
                        <span style="color: #3b82f6; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-plane-arrival"></i> Visiting</span>
                    @elseif($person->status === 'Sabbatical')
                        <span style="color: #f59e0b; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-clock"></i> Sabbatical</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;">{{ $person->status ?? '—' }}</span>
                    @endif
                </td>
                <td>
                    @if($person->role)
                        <span style="display: inline-block; background: #ede9fe; color: #6d28d9; padding: 2px 8px; border-radius: 4px; font-size: 0.78rem; font-weight: 600;">{{ $person->role }}</span>
                    @else
                        <span style="color: #d1d5db;">—</span>
                    @endif
                </td>
                <td>
                    <div class="actions" style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.staff.edit', $person) }}" style="color: #3b82f6; font-size: 1rem;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.staff.destroy', $person) }}" method="POST" data-confirm="Are you sure you want to delete this staff member? This action cannot be undone." style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1rem; padding: 0;" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-user-slash" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Staff Members Found</h3>
                        <p style="margin: 0; color: #64748b;">No staff members found.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($staff->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $staff->links() }}
    </div>
    @endif
</div>
@endsection
