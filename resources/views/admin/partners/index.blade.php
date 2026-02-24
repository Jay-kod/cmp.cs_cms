@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Partners')

@section('content')
{{-- Header Card --}}
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem; color: #0f172a;">Industry Partners</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">Manage the department's academic and industry partnerships.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
        <i class="fa-solid fa-plus"></i> Add Partner
    </a>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

{{-- Partner List --}}
@forelse($partners as $partner)
<div class="admin-card" style="margin-bottom: 1rem; padding: 0; overflow: hidden; display: flex; align-items: stretch; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow=''">
    {{-- Left accent strip --}}
    <div style="width: 5px; background: {{ $partner->is_active ? 'linear-gradient(to bottom, var(--color-primary), #22c55e)' : 'linear-gradient(to bottom, #94a3b8, #cbd5e1)' }}; flex-shrink: 0;"></div>

    <div style="flex: 1; padding: 1.2rem 1.5rem; display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
        {{-- Logo --}}
        <div style="width: 100px; height: 60px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 8px; flex-shrink: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            @if($partner->logo)
                <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            @else
                <i class="fa-solid fa-image" style="color: #cbd5e1; font-size: 1.5rem;"></i>
            @endif
        </div>

        {{-- Info --}}
        <div style="flex: 1; min-width: 200px;">
            <div style="font-weight: 700; color: #0f172a; font-size: 1.1rem; margin-bottom: 0.3rem;">{{ $partner->name }}</div>
            
            <div style="display: flex; align-items: center; gap: 1.2rem; flex-wrap: wrap; font-size: 0.85rem; color: #64748b;">
                @if($partner->url)
                    <a href="{{ $partner->url }}" target="_blank" style="color: #3b82f6; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        <i class="fa-solid fa-link" style="font-size: 0.75rem;"></i> {{ Str::limit(str_replace(['http://', 'https://'], '', $partner->url), 35) }}
                    </a>
                @else
                    <span style="color: #94a3b8;"><i class="fa-solid fa-link-slash"></i> No URL</span>
                @endif

                <span style="display: inline-flex; align-items: center; gap: 0.4rem; color: #475569;" title="Sort Order">
                    <i class="fa-solid fa-arrow-up-1-9"></i> Order: {{ $partner->sort_order }}
                </span>

                @if($partner->is_active)
                    <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; padding: 2px 10px; border-radius: 12px; font-weight: 600; font-size: 0.75rem;">
                        <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50%; display: inline-block;"></span> Active
                    </span>
                @else
                    <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #f1f5f9; color: #64748b; padding: 2px 10px; border-radius: 12px; font-weight: 600; font-size: 0.75rem;">
                        <span style="width: 6px; height: 6px; background: #94a3b8; border-radius: 50%; display: inline-block;"></span> Hidden
                    </span>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; gap: 0.5rem; flex-shrink: 0;">
            <a href="{{ route('admin.partners.edit', $partner) }}" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: #3b82f6; border-radius: 8px; text-decoration: none; transition: all 0.2s; font-size: 0.85rem;" title="Edit" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" style="margin: 0;" data-confirm="Are you sure you want to permanently delete {{ $partner->name }}?">
                @csrf @method('DELETE')
                <button type="submit" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #fef2f2; color: #ef4444; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; font-size: 0.85rem;" title="Delete" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@empty
<div class="admin-card" style="text-align: center; padding: 4rem 2rem;">
    <div style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: #94a3b8; font-size: 2.2rem;">
        <i class="fa-solid fa-handshake-angle"></i>
    </div>
    <h3 style="color: #334155; margin: 0 0 0.4rem; font-size: 1.2rem; font-weight: 700;">No Partners Added Yet</h3>
    <p style="color: #64748b; font-size: 0.95rem; margin: 0 0 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">Start showcasing your department's industry relationships and academic collaborations.</p>
    <a href="{{ route('admin.partners.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.7rem 1.6rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);">
        <i class="fa-solid fa-plus"></i> Add First Partner
    </a>
</div>
@endforelse

<div style="margin-top: 2rem;">
    {{ $partners->links() }}
</div>
@endsection
