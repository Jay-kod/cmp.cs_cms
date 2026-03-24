@extends($adminLayout ?? 'layouts.admin')

@section('title', $category->exists ? 'Edit Resource Category' : 'Add Resource Category')

@section('header')
    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 45px; height: 45px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-size: 1.2rem; color: var(--color-primary);">
                <i class="fa-solid {{ $category->exists ? 'fa-pen-to-square' : 'fa-folder-plus' }}"></i>
            </div>
            <div>
                <h1 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #1e293b;">{{ $category->exists ? 'Edit Resource Category' : 'Add Resource Category' }}</h1>
                <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.95rem;">
                    {{ $category->exists ? 'Update category details and availability.' : 'Create a new container for organizing resources.' }}
                </p>
            </div>
        </div>
        <a href="{{ route('admin.resource-categories.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: #475569; background: white; padding: 0.6rem 1.2rem; border-radius: 8px; border: 1px solid #cbd5e1; text-decoration: none; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#94a3b8';" onmouseout="this.style.background='white'; this.style.borderColor='#cbd5e1';">
            <i class="fa-solid fa-arrow-left"></i> Back to Categories
        </a>
    </div>
@endsection

@section('content')
<style>
    /* Premium Input Styling */
    .admin-form-input {
        width: 100%; 
        padding: 0.75rem 1rem; 
        border: 1px solid #cbd5e1; 
        border-radius: 8px; 
        font-size: 0.95rem; 
        font-family: inherit; 
        box-sizing: border-box;
        transition: all 0.2s ease-in-out;
        background-color: #f8fafc;
        color: #1e293b;
    }
    .admin-form-input:focus {
        outline: none;
        border-color: var(--color-primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
    }
    .admin-form-input::placeholder {
        color: #94a3b8;
    }
    
    .admin-form-label {
        display: block; 
        font-weight: 600; 
        margin-bottom: 0.4rem; 
        font-size: 0.9rem;
        color: #334155;
    }

    .required-asterisk {
        color: #ef4444;
        margin-left: 2px;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.95rem;
        font-family: inherit;
        transition: transform 0.2s, box-shadow 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
    }
</style>

<div class="admin-card" style="max-width: 850px; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; background: white; margin-bottom: 3rem;">
    <form action="{{ $category->exists ? route('admin.resource-categories.update', $category) : route('admin.resource-categories.store') }}" method="POST">
        @csrf
        @if($category->exists) @method('PUT') @endif

        <div style="display: flex; align-items: flex-start; gap: 0.8rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(22, 163, 74, 0.1); color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #1e293b; line-height: 1.2;">Category Information</h3>
                <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">Define the taxonomy logic and visibility of your documents.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.8rem; margin-bottom: 1.8rem;">
            <div class="form-group" style="margin: 0;">
                <label class="admin-form-label">Category Name <span class="required-asterisk">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="admin-form-input {{ $errors->has('name') ? 'border-red-500' : '' }}" required placeholder="e.g. Department Handbook">
                @error('name') <p style="color: #ef4444; font-size: 0.85rem; margin: 0.4rem 0 0; display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
            </div>

            <div class="form-group" style="margin: 0;">
                <label class="admin-form-label">URL Slug <span class="required-asterisk">*</span></label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="admin-form-input {{ $errors->has('slug') ? 'border-red-500' : '' }}" required placeholder="e.g. handbook">
                <span style="display: block; font-size: 0.8rem; color: #94a3b8; margin-top: 0.4rem;">
                    <i class="fa-solid fa-circle-info"></i> Used in URLs (lowercase, hyphen-separated).
                </span>
                @error('slug') <p style="color: #ef4444; font-size: 0.85rem; margin: 0.4rem 0 0; display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.8rem; margin-bottom: 2.5rem; align-items: stretch;">
            <div class="form-group" style="margin: 0;">
                <label class="admin-form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="admin-form-input" min="0" placeholder="e.g. 1">
                <span style="display: block; font-size: 0.8rem; color: #94a3b8; margin-top: 0.4rem;">
                    <i class="fa-solid fa-sort"></i> Lower numbers appear first in the list.
                </span>
            </div>

            <div class="form-group" style="margin: 0; display: flex; flex-direction: column; justify-content: flex-end;">
                <label style="display:flex; align-items:center; gap:0.8rem; cursor:pointer; user-select:none; background:#f8fafc; padding:1rem 1.25rem; border-radius:10px; border:1px solid #e2e8f0; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->exists ? $category->is_active : true) ? 'checked' : '' }} style="width: 22px; height: 22px; accent-color: var(--color-primary); cursor:pointer;">
                    <div>
                        <span style="font-weight:700; color:#1e293b; display:block; font-size:0.95rem;">Active Status</span>
                        <span style="font-size:0.85rem; color:#64748b;">Show category on the public resources page</span>
                    </div>
                </label>
            </div>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:1.2rem; border-top:1px solid #f1f5f9; padding-top:1.8rem;">
            <a href="{{ route('admin.resource-categories.index') }}" style="padding:0.8rem 1.8rem; border-radius:8px; font-weight:600; color:#475569; background:white; border:1px solid #cbd5e1; text-decoration:none; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'; this.style.color='#1e293b';" onmouseout="this.style.background='white'; this.style.color='#475569';">Cancel</a>
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-save"></i> {{ $category->exists ? 'Save Changes' : 'Create Category' }}
            </button>
        </div>
    </form>
</div>
@endsection

