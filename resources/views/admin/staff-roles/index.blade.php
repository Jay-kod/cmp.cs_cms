@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Staff Roles')
@section('header', 'Staff Roles')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Departmental Roles</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the roles that can be assigned to staff members.</p>
    </div>
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        <a href="#" class="btn" style="background: white; color: #374151; border: 1px solid #d1d5db; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;" title="Import from CSV/Excel (Coming Soon)">
            <i class="fa-solid fa-file-import"></i> Add in Bulk
        </a>
        <a href="{{ route('admin.staff-roles.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;">
            <i class="fa-solid fa-plus"></i> Add New Role
        </a>
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Role Name</th>
                <th style="width: 100px;">Order</th>
                <th style="width: 140px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $i => $role)
            <tr>
                <td style="color: #94a3b8;">{{ $i + 1 }}</td>
                <td>
                    <span style="display: inline-block; background: #ede9fe; color: #6d28d9; padding: 3px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ $role->name }}</span>
                </td>
                <td style="color: #6b7280;">{{ $role->sort_order }}</td>
                <td>
                    <div style="display: flex; gap: 0.75rem; align-items: center;">
                        <a href="{{ route('admin.staff-roles.edit', $role) }}" style="color: #3b82f6; font-size: 1rem;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.staff-roles.destroy', $role) }}" method="POST" data-confirm="Delete this role?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1rem; padding: 0;" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-user-slash" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Staff Members Found</h3>
                        <p style="margin: 0; color: #64748b;">No roles defined yet. Add one to get started.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
