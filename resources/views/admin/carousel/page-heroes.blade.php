@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Page Hero Images')
@section('header', 'Page Hero Images')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Page Hero Images</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the hero background images for public pages</p>
    </div>
    <a href="{{ route('admin.carousel.index') }}" class="btn" style="background: #e5e7eb; color: #374151; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-size: 0.88rem;"><i class="fa-solid fa-arrow-left"></i> Back to Carousel</a>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #f87171; font-size: 0.9rem;">
    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('admin.carousel.page-heroes.update') }}" enctype="multipart/form-data">
    @csrf
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        @php
            $pages = [
                'about' => ['title' => 'About Page Hero', 'icon' => 'fa-circle-info'],
                'academics' => ['title' => 'Academics Page Hero', 'icon' => 'fa-graduation-cap'],
                'blog' => ['title' => 'Blog/News Page Hero', 'icon' => 'fa-newspaper'],
                'contact' => ['title' => 'Contact Page Hero', 'icon' => 'fa-envelope']
            ];
        @endphp

        @foreach($pages as $key => $page)
        <div class="admin-card" style="padding: 1.2rem;">
            <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; padding-bottom: 0.8rem; border-bottom: 1px solid #e5e7eb;">
                <div style="width: 36px; height: 36px; background: rgba(22, 163, 74, 0.1); color: var(--color-primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                    <i class="fa-solid {{ $page['icon'] }}"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 0.95rem; font-weight: 600;">{{ $page['title'] }}</h4>
                    <span style="font-size: 0.75rem; color: #9ca3af;">Variables: <code style="background: #f3f4f6; padding: 0.1rem 0.3rem; border-radius: 3px;">hero_{{ $key }}</code></span>
                </div>
            </div>

            <!-- Preview -->
            <div style="position: relative; height: 160px; overflow: hidden; border-radius: 6px; margin-bottom: 1rem; background: #111827;">
                @if(isset($heroes[$key]) && $heroes[$key] && file_exists(storage_path('app/public/' . $heroes[$key])))
                    <img src="{{ asset('storage/' . $heroes[$key]) }}" alt="{{ $page['title'] }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.7;">
                    <div style="position: absolute; bottom: 0.5rem; right: 0.5rem;">
                        <span style="background: #10B981; color: white; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">Custom Set</span>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #6b7280;">
                        <i class="fa-solid fa-image" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                        <span style="font-size: 0.8rem;">Default Theme Image</span>
                    </div>
                @endif
            </div>

            <!-- Upload Input -->
            <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 1rem; text-align: center; position: relative; transition: border-color 0.2s;" ondragover="event.preventDefault(); this.style.borderColor='var(--color-primary)'" ondragleave="this.style.borderColor='#d1d5db'" ondrop="event.preventDefault(); this.style.borderColor='#d1d5db'; document.getElementById('hero_{{ $key }}').files = event.dataTransfer.files; previewHeroImage(event.dataTransfer.files[0], 'preview_{{ $key }}');">
                <input type="file" name="hero_{{ $key }}" id="hero_{{ $key }}" accept="image/*" style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" onchange="previewHeroImage(this.files[0], 'preview_{{ $key }}')">
                <div id="placeholder_{{ $key }}">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.2rem; color: #9ca3af; margin-bottom: 0.3rem; display: block;"></i>
                    <p style="margin: 0; font-size: 0.8rem; color: #6b7280;">Click or drag new image here</p>
                </div>
                <div id="preview_{{ $key }}" style="display: none;">
                    <p style="margin: 0; font-size: 0.8rem; color: var(--color-primary); font-weight: 600;"><i class="fa-solid fa-check"></i> Image selected</p>
                </div>
            </div>
            @error('hero_' . $key) <p style="color: #dc2626; font-size: 0.75rem; margin: 0.5rem 0 0;">{{ $message }}</p> @enderror
        </div>
        @endforeach
    </div>

    <div class="admin-card" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem;">
        <p style="margin: 0; font-size: 0.85rem; color: #6b7280;">
            <i class="fa-solid fa-info-circle"></i> Recommended aspect ratio is 16:9, minimum 1920x600 pixels.
        </p>
        <button type="submit" style="background: var(--color-primary); color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; font-family: inherit;">
            <i class="fa-solid fa-save"></i> Save Hero Images
        </button>
    </div>
</form>

<script>
function previewHeroImage(file, previewId) {
    if (!file) return;
    const placeholderId = previewId.replace('preview_', 'placeholder_');
    document.getElementById(previewId).style.display = 'block';
    document.getElementById(placeholderId).style.display = 'none';
}
</script>
@endsection
