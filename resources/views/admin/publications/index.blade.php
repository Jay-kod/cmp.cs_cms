@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Publications')
@section('header', 'Publications & Research')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">All Publications</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Manage staff research papers, journal articles, conference proceedings, and book chapters.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        <a href="{{ route('admin.publications.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); transition: background 0.2s;">
            <i class="fa-solid fa-plus"></i> Add Publication
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #047857; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
    <i class="fa-solid fa-check-circle" style="font-size: 1.1rem;"></i> {{ session('success') }}
</div>
@endif

<div class="admin-card" style="padding: 0; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Title</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Author</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Type</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Year</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Journal / Venue</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publications as $pub)
            <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.2rem 1.5rem;">
                    <div style="display: flex; flex-direction: column;">
                        <strong style="color: #0f172a; font-size: 0.95rem; margin-bottom: 0.3rem; line-height: 1.4;">{{ Str::limit($pub->title, 70) }}</strong>
                        @if($pub->doi)
                        <div style="font-size: 0.8rem; color: #0284c7; display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-link" style="font-size: 0.7rem;"></i> DOI: {{ $pub->doi }}</div>
                        @else
                        <div style="font-size: 0.8rem; color: #94a3b8; display: flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-book" style="font-size: 0.7rem;"></i> Publication</div>
                        @endif
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    <div style="display: inline-flex; align-items: center; gap: 0.4rem; color: #475569; font-size: 0.9rem;">
                        <i class="fa-solid fa-user-tie" style="color: #94a3b8;"></i> {{ $pub->staff?->name ?? '—' }}
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #f1f5f9; color: #475569; padding: 0.3rem 0.8rem; border-radius: 20px; font-weight: 500; font-size: 0.8rem; text-transform: capitalize; border: 1px solid #e2e8f0;">
                        {{ $pub->type ?? '—' }}
                    </span>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    <span style="font-weight: 600; color: #64748b; font-size: 0.9rem;">{{ $pub->year ?? '—' }}</span>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #64748b; font-size: 0.9rem;">
                    {{ $pub->journal ?? '—' }}
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: right;">
                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                        <a href="{{ route('admin.publications.edit', $pub) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #475569; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'" title="Edit Publication">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.publications.destroy', $pub) }}" method="POST" data-confirm="Are you sure you want to delete this publication?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Publication">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fa-solid fa-book-open" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                    <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No Publications Found</h3>
                    <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">Your department's research ledger is currently empty.</p>
                    <a href="{{ route('admin.publications.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
                        Add First Publication
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($publications->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e2e8f0; background: #fff;">
        {{ $publications->links() }}
    </div>
    @endif
</div>
@endsection
