@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Resource Categories')

@section('header')
    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 45px; height: 45px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-size: 1.2rem; color: var(--color-primary);">
                <i class="fa-solid fa-folder-tree"></i>
            </div>
            <div>
                <h1 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #1e293b;">Resource Categories</h1>
                <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.95rem;">Manage the categories for public-facing educational resources.</p>
            </div>
        </div>
        <a href="{{ route('admin.resource-categories.create') }}" class="btn-primary" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%); color: white; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(22, 163, 74, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(22, 163, 74, 0.2)';">
            <i class="fa-solid fa-plus"></i> Add Category
        </a>
    </div>
@endsection

@section('content')

@if(session('success'))
    <div style="background: #f0fdf4; color: #166534; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid #bbf7d0; font-size: 0.95rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
    </div>
@endif

<div class="admin-card" style="padding: 0; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; background: white; overflow: hidden;">
    <div style="padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-list" style="color: #94a3b8;"></i> Active Categories
        </h3>
        <span style="background: #e2e8f0; color: #475569; padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.8rem; font-weight: 700;">
            Total: {{ $categories->count() }}
        </span>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 1.2rem 2rem; font-weight: 700;">Name & Slug</th>
                    <th style="padding: 1.2rem 1rem; font-weight: 700; width: 120px; text-align: center;">Order</th>
                    <th style="padding: 1.2rem 1rem; font-weight: 700; width: 150px;">Status</th>
                    <th style="padding: 1.2rem 2rem; font-weight: 700; width: 150px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.2rem 2rem;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem; margin-bottom: 0.2rem;">{{ $category->name }}</div>
                            <div style="color: #64748b; font-size: 0.85rem; font-family: monospace; background: #f1f5f9; display: inline-block; padding: 0.1rem 0.5rem; border-radius: 4px;">{{ $category->slug }}</div>
                        </td>
                        <td style="padding: 1.2rem 1rem; text-align: center;">
                            <span style="background: #f1f5f9; color: #475569; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
                                {{ $category->sort_order }}
                            </span>
                        </td>
                        <td style="padding: 1.2rem 1rem;">
                            @if($category->is_active)
                                <span style="display:inline-flex; align-items:center; gap:0.4rem; background:#ecfdf5; color:#047857; padding:0.4rem 0.8rem; border-radius:999px; font-weight:700; font-size:0.85rem; border: 1px solid #bbf7d0;">
                                    <span style="width:6px; height:6px; background:#10b981; border-radius:50%; display:inline-block; box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);"></span> Active
                                </span>
                            @else
                                <span style="display:inline-flex; align-items:center; gap:0.4rem; background:#f1f5f9; color:#64748b; padding:0.4rem 0.8rem; border-radius:999px; font-weight:700; font-size:0.85rem; border: 1px solid #e2e8f0;">
                                    <span style="width:6px; height:6px; background:#94a3b8; border-radius:50%; display:inline-block;"></span> Hidden
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1.2rem 2rem; text-align: right;">
                            <div style="display:flex; justify-content: flex-end; gap:0.5rem;">
                                <a href="{{ route('admin.resource-categories.edit', $category) }}" style="width:38px; height:38px; display:inline-flex; align-items:center; justify-content:center; background:white; color:#3b82f6; border-radius:10px; border: 1px solid #e2e8f0; text-decoration:none; transition:all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);" title="Edit" onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#bfdbfe';" onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.resource-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Silently delete category: {{ $category->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="width:38px; height:38px; display:inline-flex; align-items:center; justify-content:center; background:white; color:#ef4444; border-radius:10px; border: 1px solid #e2e8f0; cursor:pointer; transition:all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);" title="Delete" onmouseover="this.style.background='#fef2f2'; this.style.borderColor='#fecaca';" onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:4rem 2rem; color:#64748b;">
                            <div style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: #cbd5e1; font-size: 2.5rem;">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <h4 style="margin: 0 0 0.5rem; font-size: 1.2rem; color: #1e293b; font-weight: 700;">No Categories Found</h4>
                            <p style="margin: 0 0 1.5rem; font-size: 0.95rem;">You have not created any resource categories yet.</p>
                            <a href="{{ route('admin.resource-categories.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--color-primary); font-weight: 600; text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; background: rgba(22, 163, 74, 0.1);">
                                <i class="fa-solid fa-plus"></i> Create Your First Category
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

