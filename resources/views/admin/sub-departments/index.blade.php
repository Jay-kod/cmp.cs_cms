@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Departments')
@section('header', 'Departments (Sub-Departments)')

@section('content')
<div data-aos="fade-up" class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Departments</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage sub-departments (e.g., Computer Science, Cyber Security).</p>
    </div>
    <a href="{{ route('admin.sub-departments.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add Department</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Prefix</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $dept)
            <tr>
                <td>{{ $dept->id }}</td>
                <td><strong>{{ $dept->name }}</strong><br><small style="color: #6b7280;">/department/{{ $dept->slug }}</small></td>
                <td><span style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 500;">{{ $dept->prefix }}</span></td>
                <td>
                    @if($dept->is_active)
                        <span style="color: var(--color-primary); font-weight: 600;"><i class="fa-solid fa-check-circle"></i> Active</span>
                    @else
                        <span style="color: #ef4444; font-weight: 600;"><i class="fa-solid fa-times-circle"></i> Inactive</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.sub-departments.edit', $dept) }}" style="color: #3b82f6; text-decoration: none;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.sub-departments.destroy', $dept) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color: #ef4444; cursor: pointer;" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;">No departments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $departments->links() }}
</div>
@endsection
