@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Resources Catalog')

@section('content')
    <div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="margin: 0; font-size: 1.1rem; color: #0f172a;">Resources Catalog</h2>
            <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">Upload and manage downloadable resources (PDF/Excel/CSV/etc.).</p>
        </div>
        <a href="{{ route('admin.resources.create') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-plus"></i> Add Resource
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 1.5rem;">
        <form method="GET" action="{{ route('admin.resources.index') }}" style="display:flex; align-items:end; gap: 1rem; flex-wrap: wrap;">
            <div style="min-width: 260px;">
                <label style="display:block; font-weight:800; color:#334155; margin-bottom:0.4rem;">Filter by Category</label>
                <select name="category_id" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;">
                    <option value="">All Categories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ (string)$c->id === (string)$categoryId ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color:white; border:none; padding:0.65rem 1.1rem; border-radius:8px; font-weight:900;">
                Apply
            </button>
        </form>
    </div>

    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
            <tr>
                <th style="width: 60px;">ID</th>
                <th>Title</th>
                <th style="width: 220px;">Category</th>
                <th style="width: 110px;">Active</th>
                <th style="width: 160px;">File</th>
                <th style="width: 200px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td style="color:#94a3b8; font-weight:800;">{{ $item->id }}</td>
                    <td style="font-weight:800; color:#0f172a;">{{ $item->title }}</td>
                    <td>{{ $item->category?->name ?? '—' }}</td>
                    <td>
                        @if($item->is_active)
                            <span style="display:inline-flex; align-items:center; gap:0.35rem; background:#ecfdf5; color:#047857; padding:2px 10px; border-radius:999px; font-weight:900; font-size:0.8rem;">
                                <span style="width:8px; height:8px; background:#10b981; border-radius:50%; display:inline-block;"></span> Yes
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:0.35rem; background:#f1f5f9; color:#64748b; padding:2px 10px; border-radius:999px; font-weight:900; font-size:0.8rem;">
                                <span style="width:8px; height:8px; background:#94a3b8; border-radius:50%; display:inline-block;"></span> No
                            </span>
                        @endif
                    </td>
                    <td style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width: 220px;">
                        <a href="{{ Storage::disk('public')->url($item->file_path) }}" target="_blank" rel="noopener noreferrer" class="btn" style="padding:0.45rem 0.65rem; border-radius:8px; text-decoration:none; background:#f1f5f9; color: #3b82f6; font-weight:900;">
                            Open
                        </a>
                    </td>
                    <td style="display:flex; gap:0.5rem; align-items:center;">
                        <a href="{{ route('admin.resources.edit', $item) }}" class="btn" style="padding:0.45rem 0.7rem; border-radius:6px; text-decoration:none; background:#f1f5f9; color:#3b82f6; font-weight:900;">
                            Edit
                        </a>
                        <form action="{{ route('admin.resources.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete resource \"{{ $item->title }}\"?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn" style="padding:0.45rem 0.7rem; border-radius:6px; background:#fef2f2; color:#ef4444; font-weight:900; border:none;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:3rem 1rem; color:#64748b;">
                        <i class="fa-solid fa-file-arrow-up" style="font-size:3rem; margin-bottom:1rem; display:block; color:#cbd5e1;"></i>
                        No resources found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div style="margin-top: 1.5rem;">
            {{ $items->links() }}
        </div>
    </div>
@endsection

