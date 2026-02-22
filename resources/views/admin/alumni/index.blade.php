@extends('layouts.admin')
@section('title', 'Manage Alumni Data')
@section('header', 'Alumni Directory')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Alumni Database</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage graduate profiles, career tracking, and success stories.</p>
    </div>
    <a href="{{ route('admin.alumni.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add Alumni Record</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Profile Name</th>
                <th>Graduation details</th>
                <th>Current Status & Employer</th>
                <th>Featured photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumni as $alumnus)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ $alumnus->photo ? asset('storage/'.$alumnus->photo) : asset('build/assets/placeholder.jpg') }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb;" onerror="this.src='https://via.placeholder.com/40?text=A'">
                        <div>
                            <strong style="color: var(--color-primary);">{{ $alumnus->name }}</strong>
                        </div>
                    </div>
                </td>
                <td>
                    <strong>Class of {{ $alumnus->graduation_year }}</strong><br>
                    <span style="font-size: 0.8rem; color: #6b7280;">{{ Str::limit($alumnus->programme, 25) }}</span>
                </td>
                <td>
                    @if($alumnus->current_role && $alumnus->employer)
                        {{ $alumnus->current_role }} at <strong>{{ $alumnus->employer }}</strong>
                    @elseif($alumnus->current_role)
                        {{ $alumnus->current_role }}
                    @elseif($alumnus->employer)
                        Works at <strong>{{ $alumnus->employer }}</strong>
                    @else
                        <span style="color: #9ca3af; font-style: italic;">No employment data</span>
                    @endif
                </td>
                <td>
                    @if($alumnus->photo)
                        <span style="color: #10B981;"><i class="fa-solid fa-check"></i> Has Photo</span>
                    @else
                        <span style="color: #6b7280;"><i class="fa-solid fa-xmark"></i> Missing</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.alumni.edit', $alumnus) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.alumni.destroy', $alumnus) }}" method="POST" data-confirm="Erase this alumni record?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;">No alumni records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($alumni->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $alumni->links() }}
    </div>
    @endif
</div>
@endsection
