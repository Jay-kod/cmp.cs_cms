@extends($adminLayout ?? 'layouts.admin')

@section('title', $partner->exists ? 'Edit Partner' : 'Add Partner')

@section('content')
<div class="admin-card" style="max-width: 800px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
        <div>
            <h2 style="margin: 0; font-size: 1.25rem; color: #0f172a; font-weight: 700;">{{ $partner->exists ? 'Edit Partner' : 'Add New Partner' }}</h2>
            <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">{{ $partner->exists ? 'Update existing partner information.' : 'Register a new industry or academic partner.' }}</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; background: #f1f5f9; color: #475569; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($partner->exists) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="font-weight: 600; color: #334155; margin-bottom: 0.4rem;">Partner Name <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem; transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'" required placeholder="e.g. Microsoft Nigeria">
            </div>

            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="font-weight: 600; color: #334155; margin-bottom: 0.4rem;">Website URL</label>
                <input type="url" name="url" value="{{ old('url', $partner->url) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem; transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'" placeholder="https://example.com">
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
            <label class="form-label" style="font-weight: 600; color: #334155; margin-bottom: 0.8rem; display: block;">Partner Logo {!! !$partner->exists ? '<span style="color: #ef4444;">*</span>' : '' !!}</label>
            
            <div style="display: flex; gap: 2rem; align-items: flex-start; flex-wrap: wrap;">
                @if($partner->logo)
                    <div style="width: 140px; height: 100px; border: 1px dashed #cbd5e1; padding: 15px; border-radius: 10px; background: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                        <img src="{{ Storage::url($partner->logo) }}" alt="Current Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                @endif
                <div style="flex: 1; min-width: 250px;">
                    <input type="file" name="logo" class="form-control" accept="image/*" {{ !$partner->exists ? 'required' : '' }} style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.5rem; background: white;">
                    <div style="margin-top: 0.75rem; font-size: 0.82rem; color: #64748b; line-height: 1.5;">
                        <ul style="margin: 0; padding-left: 1.2rem;">
                            <li>Recommended format: <strong>Transparent PNG or WebP</strong></li>
                            <li>Ideal aspect ratio: Landscape (e.g. 400x200px)</li>
                            <li>Max file size: 2MB</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="font-weight: 600; color: #334155; margin-bottom: 0.4rem;">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem;">
                <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #64748b;">Lower numbers naturally appear earlier in the scrolling marquee.</p>
            </div>

            <div class="form-group" style="margin: 0; display: flex; flex-direction: column; justify-content: center; padding-top: 0.8rem;">
                <label style="display: inline-flex; align-items: center; gap: 0.75rem; cursor: pointer; user-select: none; background: #f8fafc; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->exists ? $partner->is_active : true) ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: var(--color-primary); cursor: pointer;">
                    <div>
                        <span style="font-weight: 600; color: #0f172a; display: block; font-size: 0.95rem;">Active Status</span>
                        <span style="font-size: 0.8rem; color: #64748b;">Show this partner publicly on the home page</span>
                    </div>
                </label>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
            <a href="{{ route('admin.partners.index') }}" class="btn" style="padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; color: #475569; background: white; border: 1px solid #cbd5e1; text-decoration: none;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; border-radius: 8px; font-weight: 600; background: var(--color-primary); display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 14px rgba(22, 163, 74, 0.25);">
                <i class="fa-solid fa-save"></i> {{ $partner->exists ? 'Save Changes' : 'Create Partner' }}
            </button>
        </div>
    </form>
</div>
@endsection
