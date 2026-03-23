@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Resource Categories')

@section('content')
    <div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="margin: 0; font-size: 1.1rem; color: #0f172a;">Resource Categories</h2>
            <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">Manage categories used by the public resources page.</p>
        </div>
        <a href="{{ route('admin.resource-categories.create') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-plus"></i> Add Category
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
            <tr>
                <th>Slug</th>
                <th>Name</th>
                <th style="width: 120px;">Sort</th>
                <th style="width: 120px;">Active</th>
                <th style="width: 170px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $c)
                <tr>
                    <td style="color: #0f172a; font-weight: 800;">{{ $c->slug }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->sort_order }}</td>
                    <td>
                        @if($c->is_active)
                            <span style="display:inline-flex; align-items:center; gap:0.4rem; background:#ecfdf5; color:#047857; padding:2px 10px; border-radius:999px; font-weight:800; font-size:0.8rem;"><span style="width:8px; height:8px; background:#10b981; border-radius:50%; display:inline-block;"></span> Active</span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:0.4rem; background:#f1f5f9; color:#64748b; padding:2px 10px; border-radius:999px; font-weight:800; font-size:0.8rem;"><span style="width:8px; height:8px; background:#94a3b8; border-radius:50%; display:inline-block;"></span> Hidden</span>
                        @endif
                    </td>
                    <td style="display:flex; gap:0.5rem; align-items:center;">
                        <a href="{{ route('admin.resource-categories.edit', $c) }}" class="btn" style="padding:0.45rem 0.7rem; border-radius:6px; text-decoration:none; background:#f1f5f9; color:#3b82f6; font-weight:800;">
                            Edit
                        </a>
                        <form action="{{ route('admin.resource-categories.destroy', $c) }}" method="POST" onsubmit="return confirm('Delete category \"{{ $c->name }}\"?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn" style="padding:0.45rem 0.7rem; border-radius:6px; background:#fef2f2; color:#ef4444; font-weight:800; border:none;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:3rem 1rem; color:#64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size:2rem; margin-bottom:0.8rem; display:block;"></i>
                        No categories found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Resource Categories')
@section('content')

<div class="admin-card" style="margin-bottom: 1.5rem; display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap;">
    <div>
        <h2 style="margin: 0 0 0.25rem; font-size: 1.1rem; color:#0f172a; font-weight:800;">Resource Categories</h2>
        <p style="margin: 0; color:#64748b; font-size:0.85rem;">Manage categories used by the public Resources page.</p>
    </div>
    <a href="{{ route('admin.resource-categories.create') }}" class="btn btn-primary" style="background: var(--color-primary); color:white; padding:0.6rem 1.4rem; border-radius:8px; text-decoration:none; font-weight:700; display:inline-flex; align-items:center; gap:0.4rem;">
        <i class="fa-solid fa-plus"></i> Add Category
    </a>
</div>

@if(session('success'))
    <div style="background:#ecfdf5; color:#047857; padding:1rem; border-radius:8px; margin-bottom:1rem; border:1px solid #a7f3d0; font-size:0.9rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Slug</th>
                <th>Name</th>
                <th style="width:120px;">Order</th>
                <th style="width:120px;">Active</th>
                <th style="width:170px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td style="color:#94a3b8; font-weight:700;">{{ $category->slug }}</td>
                    <td>{{ $category->name }}</td>
                    <td style="color:#475569;">{{ $category->sort_order }}</td>
                    <td>
                        @if($category->is_active)
                            <span style="color:#10B981; font-weight:800;"><i class="fa-solid fa-check-circle"></i> Active</span>
                        @else
                            <span style="color:#94a3b8; font-weight:800;"><i class="fa-solid fa-eye-slash"></i> Hidden</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:0.5rem;">
                            <a href="{{ route('admin.resource-categories.edit', $category) }}" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; background:#f1f5f9; color:#3b82f6; border-radius:8px; text-decoration:none; transition:all 0.2s;" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.resource-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete category {{ $category->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; background:#fef2f2; color:#ef4444; border-radius:8px; border:none; cursor:pointer; transition:all 0.2s;" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:3rem 1rem; color:#64748b;">
                        No categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

