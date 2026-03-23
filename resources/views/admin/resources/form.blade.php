@extends($adminLayout ?? 'layouts.admin')
@section('title', $item->exists ? 'Edit Resource' : 'Add Resource')

@section('content')
    <div class="admin-card" style="max-width: 900px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
            <div>
                <h2 style="margin: 0; font-size: 1.25rem; color: #0f172a; font-weight: 800;">
                    {{ $item->exists ? 'Edit Resource' : 'Add New Resource' }}
                </h2>
                <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">
                    Upload a file and set it active to show it publicly.
                </p>
            </div>
            <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ $item->exists ? route('admin.resources.update', $item) : route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($item->exists) @method('PUT') @endif

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem;">Category <span style="color:#ef4444;">*</span></label>
                    <select name="category_id" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ old('category_id', $item->category_id ?? '') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem;">Title <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" required placeholder="e.g. Department Handbook (2026)">
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem; display:block;">Description</label>
                <textarea name="description" rows="4" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;">{{ old('description', $item->description ?? '') }}</textarea>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">
                    <div>
                        <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem; display:block;">
                            Upload File <span style="color:#ef4444;">*</span>
                        </label>
                        <input type="file" name="file" class="form-control" accept=".pdf,.xlsx,.csv,.doc,.docx,.txt" {{ $item->exists ? '' : 'required' }} style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.5rem; background: white;">
                        <small style="color: #64748b;">Accepted: PDF, XLSX, CSV, DOC/DOCX, TXT. Max 5MB.</small>
                    </div>

                    <div>
                        @if($item->exists && $item->file_path)
                            <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem; display:block;">Current File</label>
                            <div style="display:flex; flex-direction:column; gap:0.6rem;">
                                <a href="{{ Storage::disk('public')->url($item->file_path) }}" target="_blank" rel="noopener noreferrer" style="color: var(--color-primary); text-decoration: underline; font-size: 0.95rem; font-weight:800;">
                                    Open current file
                                </a>
                                <p style="margin:0; color:#64748b; font-size:0.85rem;">Changing the file will replace the stored file and update the link publicly.</p>
                            </div>
                        @else
                            <p style="margin:0; color:#64748b; font-size:0.85rem;">No file uploaded yet.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                <div>
                    <label class="form-label" style="font-weight: 800; color: #334155; margin-bottom: 0.4rem; display:block;">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;" min="0">
                </div>

                <div style="display:flex; flex-direction:column; justify-content:center;">
                    <label style="display:flex; align-items:center; gap: 0.75rem; cursor:pointer; user-select:none; background:#f8fafc; padding:0.8rem 1rem; border-radius: 8px; border:1px solid #e2e8f0;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->exists ? $item->is_active : true) ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: var(--color-primary); cursor:pointer;">
                        <div>
                            <span style="font-weight: 900; color: #0f172a; display:block; font-size: 0.95rem;">Active Status</span>
                            <span style="font-size: 0.8rem; color:#64748b;">Show this resource publicly</span>
                        </div>
                    </label>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                <a href="{{ route('admin.resources.index') }}" class="btn" style="padding:0.75rem 1.5rem; border-radius:8px; font-weight:800; color:#475569; background:white; border:1px solid #cbd5e1; text-decoration:none;">Cancel</a>
                <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; border-radius:8px; font-weight:900; background: var(--color-primary); color:white; border:none; display:inline-flex; align-items:center; gap:0.6rem;">
                    <i class="fa-solid fa-save"></i> {{ $item->exists ? 'Save Changes' : 'Create Resource' }}
                </button>
            </div>
        </form>
    </div>
@endsection

