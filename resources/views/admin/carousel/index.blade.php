@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Carousel Slides')
@section('header', 'Carousel & Media')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Homepage Carousel</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the hero carousel slides shown on the homepage</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        <a href="{{ route('admin.carousel.page-heroes') }}" class="btn" style="background: #4b5563; color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-size: 0.88rem;"><i class="fa-solid fa-images"></i> Page Heroes</a>
        <a href="{{ route('admin.carousel.footer-bg') }}" class="btn" style="background: #1f2937; color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-size: 0.88rem;"><i class="fa-solid fa-image"></i> Footer Background</a>
        <a href="{{ route('admin.carousel.create') }}" class="btn" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none; font-size: 0.88rem;"><i class="fa-solid fa-plus"></i> Add Slide</a>
    </div>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- Carousel Preview --}}
<div class="admin-card" style="margin-bottom: 1.5rem; padding: 0; overflow: hidden;">
    <div style="padding: 1rem 1.2rem; border-bottom: 1px solid #e5e7eb;">
        <h4 style="margin: 0; font-size: 0.88rem; color: #6b7280; font-weight: 600;">Live Preview</h4>
    </div>
    <div style="position: relative; height: 200px; overflow: hidden;">
        @php $previewSlides = $slides->where('is_active', true)->take(3); @endphp
        @forelse($previewSlides as $i => $pSlide)
        <div style="position: absolute; inset: 0; {{ $i > 0 ? 'display:none;' : '' }} background: {{ $pSlide->image_url ? "url('".$pSlide->image_url."')" : 'linear-gradient(135deg, var(--color-primary), var(--color-secondary))' }}; background-size: cover; background-position: center;">
            <div style="position: absolute; inset: 0; background: {{ $pSlide->overlay_color }};"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; height: 100%; text-align: center; color: white; padding: 1rem;">
                <div>
                    <h3 style="margin: 0 0 0.3rem; font-size: 1.1rem; color: white;">{{ $pSlide->title }}</h3>
                    <p style="margin: 0; font-size: 0.8rem; opacity: 0.9;">{{ Str::limit($pSlide->subtitle, 80) }}</p>
                </div>
            </div>
        </div>
        @empty
        <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f3f4f6; color: #9ca3af;">
            <span>No active slides to preview</span>
        </div>
        @endforelse
    </div>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 80px;">Image</th>
                <th>Title</th>
                <th>Button</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($slides as $slide)
            <tr>
                <td style="color: #9ca3af; font-size: 0.82rem;">{{ $slide->sort_order }}</td>
                <td>
                    @if($slide->image_url)
                    <img src="{{ $slide->image_url }}" alt="" style="width: 70px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                    @else
                    <div style="width: 70px; height: 45px; border-radius: 4px; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-image" style="color: white; font-size: 0.8rem;"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $slide->title }}</strong>
                    <br><span style="font-size: 0.78rem; color: #9ca3af;">{{ Str::limit($slide->subtitle, 60) }}</span>
                </td>
                <td>
                    @if($slide->button_text)
                    <code style="background: #f3f4f6; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.78rem;">{{ $slide->button_text }}</code>
                    <br><span style="font-size: 0.72rem; color: #9ca3af;">{{ $slide->button_url }}</span>
                    @else
                    <span style="color: #d1d5db; font-size: 0.82rem;">None</span>
                    @endif
                </td>
                <td>
                    @if($slide->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.carousel.edit', $slide) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.carousel.destroy', $slide) }}" method="POST" data-confirm="Delete this slide?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-images" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Carousel Slides Found</h3>
                        <p style="margin: 0; color: #64748b;">No carousel slides added yet.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
