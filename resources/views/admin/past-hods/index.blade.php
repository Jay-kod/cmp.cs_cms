@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Past HODs')
@section('header', 'Past HODs')

@section('content')
{{-- Header Card --}}
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem; color: #0f172a;">Department Heads History</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.85rem;">Manage the chronological list of past and present HODs.</p>
    </div>
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        <a href="{{ route('admin.bulk-import.show', 'past-hods') }}" class="btn" style="background: white; color: #374151; border: 1px solid #d1d5db; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;" title="Import HODs from CSV">
            <i class="fa-solid fa-file-import"></i> Add in Bulk
        </a>
        <a href="{{ route('admin.past-hods.create') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-plus"></i> Add HOD
        </a>
    </div>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

{{-- HOD Cards --}}
@forelse($hods as $h)
<div class="admin-card" style="margin-bottom: 1rem; padding: 0; overflow: hidden; display: flex; align-items: stretch; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow=''">
    {{-- Left accent strip --}}
    <div style="width: 5px; background: {{ $h->tenure_end ? 'linear-gradient(to bottom, #94a3b8, #cbd5e1)' : 'linear-gradient(to bottom, var(--color-primary), #22c55e)' }}; flex-shrink: 0;"></div>

    <div style="flex: 1; padding: 1.2rem 1.5rem; display: flex; align-items: center; gap: 1.2rem; flex-wrap: wrap;">
        {{-- Photo --}}
        @if($h->photo)
            <img src="{{ asset('storage/'.$h->photo) }}" alt="{{ $h->name }}" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 3px solid {{ $h->tenure_end ? '#e2e8f0' : '#bbf7d0' }}; flex-shrink: 0;">
        @else
            <div style="width: 56px; height: 56px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.3rem; flex-shrink: 0; border: 3px solid #e2e8f0;"><i class="fa-solid fa-user-tie"></i></div>
        @endif

        {{-- Info --}}
        <div style="flex: 1; min-width: 180px;">
            <div style="font-weight: 700; color: #0f172a; font-size: 1rem; margin-bottom: 0.2rem;">{{ $h->name }}</div>
            <div style="display: flex; align-items: center; gap: 0.8rem; flex-wrap: wrap; font-size: 0.82rem; color: #64748b;">
                <span><i class="fa-regular fa-calendar" style="width: 14px;"></i> {{ $h->tenure_start ?? '?' }} — {{ $h->tenure_end ?? 'Present' }}</span>
                @if(!$h->tenure_end)
                    <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; padding: 2px 10px; border-radius: 12px; font-weight: 600; font-size: 0.75rem;">
                        <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50; display: inline-block;"></span> Current HOD
                    </span>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; gap: 0.5rem; flex-shrink: 0;">
            <a href="{{ route('admin.past-hods.edit', $h) }}" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: #3b82f6; border-radius: 8px; text-decoration: none; transition: all 0.2s; font-size: 0.85rem;" title="Edit" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('admin.past-hods.destroy', $h) }}" method="POST" style="margin: 0;" data-confirm="Are you sure you want to remove {{ $h->name }} from the HOD list?">
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
    <i class="fa-solid fa-users-slash" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: #374151; margin: 0 0 0.3rem; font-size: 1.1rem;">No HODs Added Yet</h3>
    <p style="color: #6b7280; font-size: 0.9rem; margin: 0 0 1.5rem;">Start building the department's leadership history.</p>
    <a href="{{ route('admin.past-hods.create') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; background: var(--color-primary); color: white; padding: 0.6rem 1.4rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
        <i class="fa-solid fa-plus"></i> Add First HOD
    </a>
</div>
@endforelse
@endsection
