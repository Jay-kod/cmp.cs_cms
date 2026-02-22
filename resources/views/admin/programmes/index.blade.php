@extends('layouts.admin')
@section('title', 'Manage Programmes')
@section('header', 'Academic Programmes')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Programmes</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the academic offerings of the department.</p>
    </div>
    <a href="{{ route('admin.programmes.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add New Programme</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Programme Name</th>
                <th>Level</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programmes as $prog)
            <tr>
                <td><strong>{{ $prog->name }}</strong><br><span style="font-size: 0.8rem; color: #6b7280;">{{ $prog->slug }}</span></td>
                <td>{{ $prog->level }}</td>
                <td>{{ $prog->duration }}</td>
                <td>
                    @if($prog->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.programmes.edit', $prog) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.programmes.destroy', $prog) }}" method="POST" data-confirm="Delete this programme? All associated courses may be orphaned." style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;">No programmes found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($programmes->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $programmes->links() }}
    </div>
    @endif
</div>
@endsection
