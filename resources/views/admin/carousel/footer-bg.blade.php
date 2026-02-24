@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Footer Background')
@section('header', 'Footer Background Image')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Footer Background</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Upload a background image for the website footer area</p>
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

<div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;">
    {{-- Preview --}}
    <div class="admin-card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1rem 1.2rem; border-bottom: 1px solid #e5e7eb;">
            <h4 style="margin: 0; font-size: 0.88rem; color: #6b7280; font-weight: 600;">Current Footer Background</h4>
        </div>
        <div style="position: relative; height: 250px; overflow: hidden;">
            @if($footerBg && file_exists(storage_path('app/public/' . $footerBg)))
            <img src="{{ asset('storage/' . $footerBg) }}" alt="Footer Background" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; inset: 0; background: rgba(17,24,39,0.85);"></div>
            <div style="position: absolute; bottom: 1rem; left: 1rem; right: 1rem; display: flex; justify-content: space-between; align-items: flex-end; z-index: 1;">
                <div>
                    <p style="margin: 0; color: #9ca3af; font-size: 0.8rem;">Image Path</p>
                    <code style="background: rgba(0,0,0,0.3); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.78rem; color: #d1d5db;">storage/{{ $footerBg }}</code>
                </div>
                <span style="background: #10B981; color: white; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.72rem; font-weight: 600;">Active</span>
            </div>
            @else
            <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #111827; color: #6b7280;">
                <div style="text-align: center;">
                    <i class="fa-solid fa-image" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    <span style="font-size: 0.88rem;">No footer background image set</span>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Upload Form --}}
    <div>
        <form method="POST" action="{{ route('admin.carousel.footer-bg.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="admin-card" style="padding: 1.2rem;">
                <h4 style="margin: 0 0 1rem; font-size: 0.92rem; font-weight: 600; padding-bottom: 0.6rem; border-bottom: 1px solid #e5e7eb;">Upload New Image</h4>

                <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 1.5rem; text-align: center; position: relative; transition: border-color 0.2s; margin-bottom: 1rem;" ondragover="event.preventDefault(); this.style.borderColor='var(--color-primary)'" ondragleave="this.style.borderColor='#d1d5db'" ondrop="event.preventDefault(); this.style.borderColor='#d1d5db'; document.getElementById('footer_bg').files = event.dataTransfer.files; previewFooterBg(event.dataTransfer.files[0]);">
                    <input type="file" name="footer_bg" id="footer_bg" accept="image/*" style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" onchange="previewFooterBg(this.files[0])">
                    <div id="footerUploadPlaceholder">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.5rem; color: #9ca3af; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="margin: 0; font-size: 0.85rem; color: #6b7280;">Click or drag image here</p>
                        <p style="margin: 0.3rem 0 0; font-size: 0.72rem; color: #9ca3af;">JPG, PNG, WebP — Max 5MB</p>
                    </div>
                    <div id="footerPreview" style="display: none;">
                        <img id="footerPreviewImg" src="" alt="Preview" style="max-width: 100%; max-height: 150px; border-radius: 6px; object-fit: cover;">
                    </div>
                </div>

                @error('footer_bg') <p style="color: #dc2626; font-size: 0.8rem; margin: 0 0 0.5rem;">{{ $message }}</p> @enderror

                <p style="margin: 0 0 1rem; font-size: 0.78rem; color: #9ca3af;">
                    <i class="fa-solid fa-info-circle"></i> Use a wide, high-resolution image (1920×600 or larger) for best results. The image will have a dark overlay applied automatically.
                </p>

                <button type="submit" style="width: 100%; background: var(--color-primary); color: white; padding: 0.7rem 1.2rem; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; font-family: inherit;">
                    <i class="fa-solid fa-upload"></i> Update Footer Background
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewFooterBg(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('footerPreviewImg').src = e.target.result;
        document.getElementById('footerPreview').style.display = '';
        document.getElementById('footerUploadPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
