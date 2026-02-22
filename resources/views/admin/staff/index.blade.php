@extends('layouts.admin')
@section('title', 'Manage Staff')
@section('header', 'Staff Directory')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Staff Members</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage department personnel, ranks, and roles.</p>
    </div>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add New Staff</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Rank</th>
                <th>Specialisation</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staff as $person)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ $person->photo ? asset('storage/'.$person->photo) : asset('build/assets/placeholder.jpg') }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb;" onerror="this.src='https://via.placeholder.com/40?text=S'">
                        <div>
                            <strong>{{ $person->title }} {{ $person->name }}</strong>
                            @if($person->is_hod) <span style="background: var(--color-accent); color: var(--color-primary); padding: 2px 6px; border-radius: 10px; font-size: 0.65rem; font-weight: bold; margin-left: 5px; text-transform: uppercase;">HOD</span> @endif
                        </div>
                    </div>
                </td>
                <td>{{ $person->rank }}</td>
                <td>{{ Str::limit($person->specialisation, 30) }}</td>
                <td>
                    @if($person->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.staff.edit', $person) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.staff.destroy', $person) }}" method="POST" data-confirm="Are you sure you want to delete this staff member? This action cannot be undone." style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;">No staff members found.</td>
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
