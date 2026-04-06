@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Resources Catalog')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">Resources Catalog</h2>
            <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Upload and manage downloadable resources (PDF/Excel/CSV/etc.).</p>
        </div>
        <div style="display: flex; gap: 0.6rem;">
            <a href="{{ route('admin.resource-categories.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #f8fafc; color: #475569; border: 1px solid #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: all 0.2s;">
                <i class="fa-solid fa-layer-group"></i> Manage Categories
            </a>
            <a href="{{ route('admin.resources.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); transition: background 0.2s;">
                <i class="fa-solid fa-plus"></i> Add Resource
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #047857; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-check-circle" style="font-size: 1.1rem;"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card" style="margin-bottom: 1.5rem; padding: 1.2rem 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <form method="GET" action="{{ route('admin.resources.index') }}" style="display:flex; align-items:end; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 260px;">
                <label style="display:block; font-weight:600; color:#475569; font-size:0.85rem; margin-bottom:0.4rem;"><i class="fa-solid fa-filter" style="margin-right: 0.3rem;"></i> Filter by Category</label>
                <select name="category_id" class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem; background: #f8fafc; color: #334155; font-size: 0.95rem; outline: none;">
                    <option value="">All Categories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ (string)$c->id === (string)$categoryId ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'">
                <i class="fa-solid fa-magnifying-glass"></i> Filter Results
            </button>
        </form>
    </div>

    <div class="admin-card" style="padding: 0; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 60px;">ID</th>
                    <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Resource Details</th>
                    <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Category</th>
                    <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                    <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.2rem 1.5rem;">
                        <span style="color:#94a3b8; font-family: monospace; font-size: 0.85rem;">{{ $item->id === 0 ? '- EXT -' : '#' . str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td style="padding: 1.2rem 1.5rem;">
                        <div style="display: flex; flex-direction: column;">
                            <strong style="color: #0f172a; font-size: 0.95rem; margin-bottom: 0.3rem;">{{ $item->title }}</strong>
                            <a href="{{ Storage::disk('public')->url($item->file_path) }}" target="_blank" rel="noopener noreferrer" style="font-size: 0.8rem; color: #0284c7; text-decoration: none; display: flex; align-items: center; gap: 0.3rem; width: fit-content;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.7rem;"></i> View Download File
                            </a>
                        </div>
                    </td>
                    <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                        <span style="display:inline-flex; align-items:center; gap:0.3rem; background:#f1f5f9; color:#475569; padding:0.3rem 0.8rem; border-radius:20px; font-weight:500; font-size:0.8rem; border: 1px solid #e2e8f0;">
                            <i class="fa-solid fa-folder-open" style="color: #94a3b8;"></i> {{ $item->category?->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                        @if($item->is_active)
                            <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #ecfdf5; color: #059669; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #a7f3d0;">
                                <div style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></div> Active
                            </div>
                        @else
                            <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #f1f5f9; color: #64748b; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                                <i class="fa-solid fa-eye-slash" style="font-size: 0.75rem;"></i> Hidden
                            </div>
                        @endif
                    </td>
                    <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: right;">
                        <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                            @if($item->id === 0)
                                <a href="{{ route('admin.timetable.upload') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.4rem 0.8rem; border-radius: 6px; background: #eff6ff; color: #0284c7; text-decoration: none; transition: all 0.2s; font-size: 0.82rem; font-weight: 600; border: 1px solid #bfdbfe;" title="Manage Standalone Timetable">
                                    <i class="fa-solid fa-arrow-up-right-from-square" style="margin-right: 0.4rem;"></i> Update File
                                </a>
                            @else
                                <a href="{{ route('admin.resources.edit', $item) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #475569; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'" title="Edit Resource">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.resources.destroy', $item) }}" method="POST" data-confirm="Are you sure you want to permanently delete this resource?" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Resource">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 4rem 2rem;">
                        <i class="fa-solid fa-file-arrow-up" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No Resources Uploaded</h3>
                        <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">Your catalog currently has no files matching this search.</p>
                        <a href="{{ route('admin.resources.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
                            Upload File
                        </a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    
    @if($items->hasPages())
    <div style="padding: 1rem; margin-top: 1rem; border-radius: 12px; background: #fff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        {{ $items->links() }}
    </div>
    @endif
@endsection

