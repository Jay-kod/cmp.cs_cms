@extends($adminLayout ?? 'layouts.admin')
@section('title', $role->exists ? 'Edit Role' : 'Add Role')
@section('header', $role->exists ? 'Edit Role' : 'New Role')

@section('content')
<div data-aos="fade-up" class="admin-card" style="max-width: 600px;">
    <h2 style="margin: 0 0 1.5rem 0; font-size: 1.1rem;">{{ $role->exists ? 'Edit Role' : 'Create a New Role' }}</h2>

    <form action="{{ $role->exists ? route('admin.staff-roles.update', $role) : route('admin.staff-roles.store') }}" method="POST">
        @csrf
        @if($role->exists) @method('PUT') @endif

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.85rem;">
                @foreach($errors->all() as $error)
                    <div><i class="fa-solid fa-circle-exclamation"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-group" style="margin-bottom: 1.25rem;">
            <label class="form-label" style="font-weight: 600; margin-bottom: 0.4rem; display: block;">Role Name <span style="color: #ef4444;">*</span></label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control" placeholder="e.g. Exam Officer, Level Coordinator 200L" required style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" style="font-weight: 600; margin-bottom: 0.4rem; display: block;">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $role->sort_order ?? 0) }}" class="form-control" min="0" style="width: 120px; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
            <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Lower numbers appear first in the dropdown.</p>
        </div>

        <div style="display: flex; gap: 0.75rem;">
            <button type="submit" class="btn" style="background: var(--color-primary); color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                <i class="fa-solid fa-check"></i> {{ $role->exists ? 'Update Role' : 'Create Role' }}
            </button>
            <a href="{{ route('admin.staff-roles.index') }}" class="btn btn-secondary" style="padding: 0.6rem 1.5rem; border-radius: 6px; text-decoration: none; color: #374151; background: #e5e7eb;">Cancel</a>
        </div>
    </form>
</div>
@endsection
