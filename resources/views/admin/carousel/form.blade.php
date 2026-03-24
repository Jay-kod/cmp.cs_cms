@extends($adminLayout ?? 'layouts.admin')
@section('title', $slide ? 'Edit Slide' : 'Add Slide')

@section('header')
    <div style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 45px; height: 45px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-size: 1.2rem; color: var(--color-primary);">
            <i class="fa-solid fa-images"></i>
        </div>
        <div>
            <h1 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #1e293b;">{{ $slide ? 'Edit Carousel Slide' : 'Add New Slide' }}</h1>
            <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.95rem;">Configure the text, links, and background image for your homepage hero slide.</p>
        </div>
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
    
    .btn-secondary {
        padding: 0.8rem 1.5rem;
        background: white;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        color: #475569;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-secondary:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: #1e293b;
    }

    /* Dropzone */
    .image-dropzone {
        border: 2px dashed #cbd5e1; 
        border-radius: 12px; 
        padding: 2.5rem 1.5rem; 
        text-align: center; 
        position: relative; 
        transition: all 0.3s ease;
        background: #f8fafc;
        overflow: hidden;
    }
    .image-dropzone:hover, .image-dropzone.dragover {
        border-color: var(--color-primary);
        background: #f0fdf4;
    }
    .dropzone-icon {
        background: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: var(--color-primary);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>

<form method="POST" action="{{ $slide ? route('admin.carousel.update', $slide) : route('admin.carousel.store') }}" enctype="multipart/form-data">
    @csrf
    @if($slide) @method('PUT') @endif

    <div style="display: grid; grid-template-columns: 1fr 380px; gap: 1.8rem; align-items: start;">
        
        {{-- Main Content --}}
        <div class="admin-card" style="padding: 2rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(22, 163, 74, 0.1); color: var(--color-primary); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #1e293b;">Slide Content Details</h3>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="title" class="admin-form-label">Slide Title <span class="required-asterisk">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $slide->title ?? '') }}" required
                    class="admin-form-input {{ $errors->has('title') ? 'border-red-500' : '' }}"
                    placeholder="e.g. Empowering the Future of Computing">
                @error('title') <p style="color: #ef4444; font-size: 0.85rem; margin: 0.4rem 0 0; display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="subtitle" class="admin-form-label">Subtitle / Description</label>
                <textarea name="subtitle" id="subtitle" rows="3"
                    class="admin-form-input"
                    placeholder="Provide a brief description shown below the main title. Keep it punchy and engaging.">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
                @error('subtitle') <p style="color: #ef4444; font-size: 0.85rem; margin: 0.4rem 0 0;">{{ $message }}</p> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label for="button_text" class="admin-form-label">Button Text</label>
                    <div style="position: relative;">
                        <i class="fa-solid fa-font" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $slide->button_text ?? '') }}"
                            class="admin-form-input" style="padding-left: 2.5rem;"
                            placeholder="e.g. Discover More">
                    </div>
                </div>
                <div>
                    <label for="button_url" class="admin-form-label">Button URL</label>
                    <div style="position: relative;">
                        <i class="fa-solid fa-link" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $slide->button_url ?? '') }}"
                            class="admin-form-input" style="padding-left: 2.5rem;"
                            placeholder="e.g. /about or https://...">
                    </div>
                </div>
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="image" class="admin-form-label" style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <span>Background Image</span>
                    @if($slide && $slide->image_url)
                        <span style="font-size: 0.8rem; font-weight: 500; color: var(--color-primary); background: #f0fdf4; padding: 0.2rem 0.6rem; border-radius: 20px;">Image uploaded</span>
                    @endif
                </label>
                
                <div class="image-dropzone" id="dropZone" 
                    ondragover="event.preventDefault(); this.classList.add('dragover');" 
                    ondragleave="this.classList.remove('dragover');" 
                    ondrop="event.preventDefault(); this.classList.remove('dragover'); document.getElementById('image').files = event.dataTransfer.files; previewImage(event.dataTransfer.files[0]);">
                    
                    <input type="file" name="image" id="image" accept="image/*" style="position: absolute; inset: 0; opacity: 0; cursor: pointer; z-index: 10;" onchange="previewImage(this.files[0])">
                    
                    <div id="uploadPlaceholder" style="{{ ($slide && $slide->image_url) ? 'display:none;' : '' }}">
                        <div class="dropzone-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <h4 style="margin: 0 0 0.4rem; font-size: 1rem; color: #1e293b; font-weight: 600;">Drag and drop your image here</h4>
                        <p style="margin: 0 0 1rem; font-size: 0.9rem; color: #64748b;">or click to browse your computer</p>
                        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 0.8rem; background: white; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.75rem; color: #94a3b8; font-weight: 500;">
                            <i class="fa-solid fa-image"></i> JPG, PNG, WebP (Max 5MB)
                        </div>
                    </div>
                    
                    <div id="imagePreview" style="{{ ($slide && $slide->image_url) ? '' : 'display:none;' }} position: relative; width: 100%;">
                        <img id="previewImg" src="{{ ($slide && $slide->image_url) ? $slide->image_url : '' }}" alt="Preview" style="max-width: 100%; max-height: 280px; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        
                        <div style="position: absolute; bottom: -1rem; left: 50%; transform: translateX(-50%); background: white; border: 1px solid #e2e8f0; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 0.4rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); z-index: 20; pointer-events: none;">
                            <i class="fa-solid fa-camera-rotate"></i> Click or drag to replace
                        </div>
                    </div>
                </div>
                @error('image') <p style="color: #ef4444; font-size: 0.85rem; margin: 0.5rem 0 0;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Sidebar --}}
        <div style="position: sticky; top: 1.5rem;">
            <div class="admin-card" style="padding: 1.8rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; margin-bottom: 1.5rem;">
                <h4 style="margin: 0 0 1.2rem; font-size: 1.05rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-sliders" style="color: var(--color-primary);"></i> Configurations
                </h4>

                <div style="margin-bottom: 1.5rem;">
                    <label for="overlay_color" class="admin-form-label">Overlay Color (Gradient Top)</label>
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <input type="text" name="overlay_color" id="overlay_color" value="{{ old('overlay_color', $slide->overlay_color ?? 'rgba(0,0,0,0.5)') }}"
                            class="admin-form-input" style="font-family: monospace;"
                            placeholder="rgba(0,0,0,0.5)">
                        <div id="colorPreview" style="background: {{ old('overlay_color', $slide->overlay_color ?? 'rgba(0,0,0,0.5)') }}; width: 42px; height: 42px; border-radius: 8px; border: 1px solid #cbd5e1; flex-shrink: 0;"></div>
                    </div>
                    <p style="margin: 0.4rem 0 0; font-size: 0.8rem; color: #64748b;">Darkens the image so your white text stands out.</p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="sort_order" class="admin-form-label">Sort Order</label>
                    <div style="position: relative;">
                        <i class="fa-solid fa-arrow-down-1-9" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" min="0"
                            class="admin-form-input" style="padding-left: 2.5rem;">
                    </div>
                    <p style="margin: 0.4rem 0 0; font-size: 0.8rem; color: #64748b;">Lower numbers show up first.</p>
                </div>

                <div style="margin-bottom: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div style="display: flex; align-items: flex-start; gap: 0.8rem;">
                        <div style="padding-top: 0.1rem;">
                            <div class="custom-checkbox">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; accent-color: var(--color-primary); cursor: pointer;">
                            </div>
                        </div>
                        <div>
                            <label for="is_active" style="font-size: 0.95rem; font-weight: 600; cursor: pointer; color: #1e293b; display: block; margin-bottom: 0.2rem;">Slide Activated</label>
                            <span style="font-size: 0.85rem; color: #64748b;">Toggle this OFF to hide the slide from the homepage without deleting it.</span>
                        </div>
                    </div>
                </div>

                @if($slide)
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px dashed #e2e8f0;">
                    <div style="display: flex; align-items: flex-start; gap: 0.8rem; margin-bottom: 0.8rem;">
                        <i class="fa-regular fa-calendar-plus" style="color: #94a3b8; margin-top: 0.2rem;"></i>
                        <div>
                            <p style="margin: 0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; font-weight: 600;">Created At</p>
                            <p style="margin: 0.2rem 0 0; font-size: 0.85rem; color: #475569; font-weight: 500;">{{ $slide->created_at ? $slide->created_at->format('M j, Y — g:i A') : 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 0.8rem;">
                        <i class="fa-solid fa-clock-rotate-left" style="color: #94a3b8; margin-top: 0.2rem;"></i>
                        <div>
                            <p style="margin: 0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; font-weight: 600;">Last Updated</p>
                            <p style="margin: 0.2rem 0 0; font-size: 0.85rem; color: #475569; font-weight: 500;">{{ $slide->updated_at ? $slide->updated_at->format('M j, Y — g:i A') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <button type="submit" class="btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-cloud-arrow-up"></i> {{ $slide ? 'Save Changes' : 'Publish Slide' }}
                </button>
                <a href="{{ route('admin.carousel.index') }}" class="btn-secondary" style="width: 100%;">
                    Back to Selection
                </a>
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
        document.getElementById('imagePreview').style.display = 'block';
        document.getElementById('uploadPlaceholder').style.display = 'none';
        document.getElementById('dropZone').style.padding = '1.5rem';
    };
    reader.readAsDataURL(file);
}

// Live color preview update
document.getElementById('overlay_color').addEventListener('input', function(e) {
    document.getElementById('colorPreview').style.background = e.target.value;
});
</script>
@endsection
