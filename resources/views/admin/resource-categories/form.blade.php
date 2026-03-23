@extends($adminLayout ?? 'layouts.admin')

@section('title', $category->exists ? 'Edit Resource Category' : 'Add Resource Category')

@section('content')
    <div class="admin-card" style="max-width: 800px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
            <div>
                <h2 style="margin: 0; font-size: 1.25rem; color: #0f172a; font-weight: 800;">{{ $category->exists ? 'Edit Resource Category' : 'Add Resource Category' }}</h2>
                <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">
                    {{ $category->exists ? 'Update category details.' : 'Create a new category for organizing resources.' }}
                </p>
            </div>
            <a href="{{ route('admin.resource-categories.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ $category->exists ? route('admin.resource-categories.update', $category) : route('admin.resource-categories.store') }}" method="POST">
            @csrf
            @if($category->exists) @method('PUT') @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group" style="margin: 0;">
                    <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Slug <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" {{ $category->exists ? '' : '' }} required placeholder="e.g. handbook">
                </div>

                <div class="form-group" style="margin: 0;">
                    <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" required placeholder="e.g. Department Handbook">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group" style="margin: 0;">
                    <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" min="0">
                </div>

                <div class="form-group" style="margin: 0; display:flex; flex-direction:column; justify-content:center;">
                    <label style="display:flex; align-items:center; gap:0.75rem; cursor:pointer; user-select:none; background:#f8fafc; padding:0.8rem 1rem; border-radius:8px; border:1px solid #e2e8f0;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->exists ? $category->is_active : true) ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: var(--color-primary); cursor:pointer;">
                        <div>
                            <span style="font-weight:800; color:#0f172a; display:block; font-size:0.95rem;">Active Status</span>
                            <span style="font-size:0.8rem; color:#64748b;">Show category on public resources page</span>
                        </div>
                    </label>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #e2e8f0; padding-top:1.5rem;">
                <a href="{{ route('admin.resource-categories.index') }}" class="btn" style="padding:0.75rem 1.5rem; border-radius:8px; font-weight:800; color:#475569; background:white; border:1px solid #cbd5e1; text-decoration:none;">Cancel</a>
                <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; border-radius:8px; font-weight:900; background: var(--color-primary); color:white; border:none;">
                    {{ $category->exists ? 'Save Changes' : 'Create Category' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@extends($adminLayout ?? 'layouts.admin')

@section('title', $category->exists ? 'Edit Resource Category' : 'Add Resource Category')
@section('content')

<div class="admin-card" style="max-width: 760px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
        <div>
            <h2 style="margin:0; font-size:1.25rem; color:#0f172a; font-weight:800;">{{ $category->exists ? 'Edit Resource Category' : 'Add Resource Category' }}</h2>
            <p style="margin:0.2rem 0 0; color:#64748b; font-size:0.85rem;">Categories drive the public resources sections.</p>
        </div>
        <a href="{{ route('admin.resource-categories.index') }}" class="btn btn-secondary" style="display:inline-flex; align-items:center; gap:0.4rem; font-size:0.85rem; padding:0.5rem 1rem; border-radius:8px; font-weight:700; background:#f1f5f9; color:#475569; text-decoration:none; transition:background 0.2s;">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ $category->exists ? route('admin.resource-categories.update', $category) : route('admin.resource-categories.store') }}" method="POST">
        @csrf
        @if($category->exists)
            @method('PUT')
        @endif

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label class="form-label" style="font-weight:700; color:#334155; display:block; margin-bottom:0.4rem;">
                    Slug <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" required placeholder="e.g. handbook" class="form-control" style="border-radius:8px; border:1px solid #cbd5e1; padding:0.6rem 1rem; width:100%;">
            </div>
            <div>
                <label class="form-label" style="font-weight:700; color:#334155; display:block; margin-bottom:0.4rem;">
                    Sort Order
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="form-control" style="border-radius:8px; border:1px solid #cbd5e1; padding:0.6rem 1rem; width:100%;">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label class="form-label" style="font-weight:700; color:#334155; display:block; margin-bottom:0.4rem;">
                Name <span style="color:#ef4444;">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required placeholder="e.g. Department Handbook" class="form-control" style="border-radius:8px; border:1px solid #cbd5e1; padding:0.6rem 1rem; width:100%;">
        </div>

        <div style="display:flex; flex-direction:column; gap:0.75rem; margin-bottom: 1.5rem;">
            <label style="display:inline-flex; align-items:center; gap:0.75rem; cursor:pointer; user-select:none; background:#f8fafc; padding:0.9rem 1rem; border-radius:8px; border:1px solid #e2e8f0;">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->exists ? $category->is_active : true) ? 'checked' : '' }} style="width:20px; height:20px; accent-color: var(--color-primary); cursor:pointer;">
                <div>
                    <span style="font-weight:800; color:#0f172a; display:block;">Active Status</span>
                    <span style="color:#64748b; font-size:0.85rem;">Show this category on the public Resources page.</span>
                </div>
            </label>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #e2e8f0; padding-top: 1.25rem;">
            <a href="{{ route('admin.resource-categories.index') }}" class="btn" style="padding:0.75rem 1.5rem; border-radius:8px; font-weight:700; color:#475569; background:white; border:1px solid #cbd5e1; text-decoration:none;">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; border-radius:8px; font-weight:800; background: var(--color-primary); color:white; border:none; box-shadow: 0 4px 14px rgba(22,163,74,0.25);">
                <i class="fa-solid fa-save"></i> {{ $category->exists ? 'Save Changes' : 'Create Category' }}
            </button>
        </div>
    </form>
</div>

@endsection

