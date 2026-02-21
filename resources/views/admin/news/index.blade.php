@extends('layouts.admin')
@section('title', 'Manage News')
@section('header', 'News & Articles')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All News Articles</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage departmental news, research updates, and spotlights.</p>
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Write Article</a>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Article</th>
                <th>Category</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $article)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/'.$article->featured_image) }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                        @else
                            <div style="width: 60px; height: 45px; background: #e5e7eb; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        @endif
                        <div>
                            <strong style="color: var(--color-primary);">{{ Str::limit($article->title, 50) }}</strong>
                            <div style="font-size: 0.75rem; color: #6b7280; margin-top: 2px;">{{ $article->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </td>
                <td><span style="background: #f3f4f6; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">{{ $article->category }}</span></td>
                <td>
                    @if($article->published_at && $article->published_at <= now())
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-check"></i> Published</span>
                    @elseif($article->published_at && $article->published_at > now())
                        <span style="color: #F59E0B; font-weight: bold; font-size: 0.85rem;"><i class="fa-regular fa-clock"></i> Scheduled</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-pen"></i> Draft</span>
                    @endif
                </td>
                <td>
                    @if($article->is_featured)
                        <span style="color: var(--color-accent);"><i class="fa-solid fa-star"></i></span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news article?');" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem;">No news articles found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($news->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
