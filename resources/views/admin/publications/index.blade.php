@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Publications')
@section('header', 'Publications & Research')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Publications</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage staff research papers, journal articles, conference proceedings, and book chapters.</p>
    </div>
    <a href="{{ route('admin.publications.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add Publication</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Year</th>
                <th>Journal / Venue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publications as $pub)
            <tr>
                <td>
                    <div>
                        <strong style="color: var(--color-primary);">{{ Str::limit($pub->title, 60) }}</strong>
                        @if($pub->doi)
                        <div style="font-size: 0.75rem; color: #6b7280; margin-top: 2px;">DOI: {{ $pub->doi }}</div>
                        @endif
                    </div>
                </td>
                <td>{{ $pub->staff?->name ?? '—' }}</td>
                <td><span style="background: #f3f4f6; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; text-transform: capitalize;">{{ $pub->type ?? '—' }}</span></td>
                <td>{{ $pub->year ?? '—' }}</td>
                <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pub->journal ?? '—' }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.publications.edit', $pub) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.publications.destroy', $pub) }}" method="POST" data-confirm="Are you sure you want to delete this publication?" style="display:inline;">
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
                        <i class="fa-solid fa-book-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Publications Found</h3>
                        <p style="margin: 0; color: #64748b;">No publications found. Add your first publication.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($publications->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $publications->links() }}
    </div>
    @endif
</div>
@endsection
