@extends($adminLayout ?? 'layouts.admin')
@section('title', $slide ? 'Edit Slide' : 'Add Slide')
@section('header', $slide ? 'Edit Carousel Slide' : 'Add Carousel Slide')

@section('content')
<form method="POST" action="{{ $slide ? route('admin.carousel.update', $slide) : route('admin.carousel.store') }}" enctype="multipart/form-data">
    @csrf
    @if($slide) @method('PUT') @endif

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;">
        
        {{-- Main Content --}}
        <div class="admin-card" style="padding: 1.5rem;">
            <h3 style="margin: 0 0 1.2rem 0; font-size: 1rem; font-weight: 600;">Slide Content</h3>

            <div style="margin-bottom: 1.2rem;">
                <label for="title" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Slide Title <span style="color: #dc2626;">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $slide->title ?? '') }}" required
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid {{ $errors->has('title') ? '#f87171' : '#d1d5db' }}; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="e.g. Empowering the Future of Computing">
                @error('title') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label for="subtitle" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Subtitle / Description</label>
                <textarea name="subtitle" id="subtitle" rows="3"
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box; resize: vertical;"
                    placeholder="A brief description shown below the title">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
                @error('subtitle') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
                <div>
                    <label for="button_text" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Button Text</label>
                    <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $slide->button_text ?? '') }}"
                        style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                        placeholder="e.g. Learn More">
                </div>
                <div>
                    <label for="button_url" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Button URL</label>
                    <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $slide->button_url ?? '') }}"
                        style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                        placeholder="/about">
                </div>
            </div>

            {{-- Image Upload --}}
            <div style="margin-bottom: 1.2rem;">
                <label for="image" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Background Image</label>
                <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 1.5rem; text-align: center; position: relative; transition: border-color 0.2s;" id="dropZone" ondragover="event.preventDefault(); this.style.borderColor='var(--color-primary)'" ondragleave="this.style.borderColor='#d1d5db'" ondrop="event.preventDefault(); this.style.borderColor='#d1d5db'; document.getElementById('image').files = event.dataTransfer.files; previewImage(event.dataTransfer.files[0]);">
                    <input type="file" name="image" id="image" accept="image/*" style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" onchange="previewImage(this.files[0])">
                    <div id="uploadPlaceholder" style="{{ ($slide && $slide->image_url) ? 'display:none;' : '' }}">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2rem; color: #9ca3af; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="margin: 0; font-size: 0.88rem; color: #6b7280;">Click or drag an image here</p>
                        <p style="margin: 0.3rem 0 0; font-size: 0.75rem; color: #9ca3af;">JPG, PNG, WebP — Max 5MB</p>
                    </div>
                    <div id="imagePreview" style="{{ ($slide && $slide->image_url) ? '' : 'display:none;' }}">
                        <img id="previewImg" src="{{ ($slide && $slide->image_url) ? $slide->image_url : '' }}" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 6px; object-fit: cover;">
                    </div>
                </div>
                @error('image') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="admin-card" style="padding: 1.2rem;">
                <h4 style="margin: 0 0 1rem; font-size: 0.92rem; font-weight: 600; padding-bottom: 0.6rem; border-bottom: 1px solid #e5e7eb;">Settings</h4>

                <div style="margin-bottom: 1rem;">
                    <label for="overlay_color" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Overlay Color</label>
                    <input type="text" name="overlay_color" id="overlay_color" value="{{ old('overlay_color', $slide->overlay_color ?? 'rgba(0,0,0,0.5)') }}"
                        style="width: 100%; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;"
                        placeholder="rgba(0,0,0,0.5)">
                    <p style="margin: 0.3rem 0 0; font-size: 0.75rem; color: #9ca3af;">RGBA color for the dark overlay on the image</p>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="sort_order" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" min="0"
                        style="width: 100%; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}
                        style="width: 16px; height: 16px; accent-color: var(--color-primary);">
                    <label for="is_active" style="font-size: 0.88rem; font-weight: 500; cursor: pointer;">Active (visible on homepage)</label>
                </div>

                @if($slide)
                <div style="padding-top: 0.8rem; border-top: 1px solid #e5e7eb; font-size: 0.78rem; color: #9ca3af;">
                    <p style="margin: 0;">Created: {{ $slide->created_at->format('M j, Y g:i A') }}</p>
                    <p style="margin: 0.2rem 0 0;">Updated: {{ $slide->updated_at->format('M j, Y g:i A') }}</p>
                </div>
                @endif
            </div>

            <div style="display: flex; gap: 0.6rem; margin-top: 1rem;">
                <button type="submit" style="flex: 1; background: var(--color-primary); color: white; padding: 0.7rem 1.2rem; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; font-family: inherit;">
                    <i class="fa-solid fa-save"></i> {{ $slide ? 'Update Slide' : 'Add Slide' }}
                </button>
                <a href="{{ route('admin.carousel.index') }}" style="padding: 0.7rem 1rem; border: 1px solid #d1d5db; border-radius: 6px; color: #374151; text-decoration: none; font-size: 0.9rem; text-align: center;">Cancel</a>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = '';
        document.getElementById('uploadPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
