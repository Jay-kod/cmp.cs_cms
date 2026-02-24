@extends($adminLayout ?? 'layouts.admin')
@section('title', $category->exists ? 'Edit Category' : 'Add Category')
@section('header', $category->exists ? 'Edit Programme Category' : 'Add Programme Category')

@section('content')
<div class="admin-card">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $category->exists ? route('admin.programme-categories.update', $category) : route('admin.programme-categories.store') }}" method="POST">
        @csrf
        @if($category->exists) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div>
                <div class="form-group">
                    <label class="form-label">Category Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required placeholder="e.g. Undergraduate (Full-Time)">
                </div>

                <div class="form-group">
                    <label class="form-label">Icon (Font Awesome class)</label>
                    <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" class="form-control" placeholder="e.g. fa-solid fa-graduation-cap">
                    <small style="color: #6b7280;">Browse icons at <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a></small>
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="form-control" min="0">
                </div>

                <div class="form-group" style="padding: 1rem; background: #f9fafb; border-radius: 4px; border: 1px solid #e5e7eb;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->exists ? $category->is_active : true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Active (visible on website)</strong>
                    </label>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="6" placeholder="Brief description of this programme category...">{{ old('description', $category->description) }}</textarea>
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.programme-categories.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $category->exists ? 'Update Category' : 'Save Category' }}</button>
        </div>
    </form>
</div>
@endsection
