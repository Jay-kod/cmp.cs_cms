@extends('layouts.admin')
@section('title', 'Programme Categories')
@section('header', 'Programme Categories')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Categories</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage programme types and categories (e.g. Full-Time, Part-Time, Masters, PhD).</p>
    </div>
    <a href="{{ route('admin.programme-categories.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add Category</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Icon</th>
                <th>Category Name</th>
                <th>Programmes</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td style="text-align: center;">{{ $cat->sort_order }}</td>
                <td style="text-align: center;"><i class="{{ $cat->icon ?? 'fa-solid fa-folder' }}" style="font-size: 1.2rem; color: var(--color-primary);"></i></td>
                <td>
                    <strong>{{ $cat->name }}</strong>
                    <br><span style="font-size: 0.8rem; color: #6b7280;">{{ $cat->slug }}</span>
                </td>
                <td style="text-align: center;">
                    <span style="background: var(--color-primary); color: white; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">{{ $cat->programmes_count }}</span>
                </td>
                <td>
                    @if($cat->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.programme-categories.edit', $cat) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.programme-categories.destroy', $cat) }}" method="POST" data-confirm="Delete this category? Programmes will be uncategorized." style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Records Found</h3>
                        <p style="margin: 0; color: #64748b;">No categories found. Create one.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($categories->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
