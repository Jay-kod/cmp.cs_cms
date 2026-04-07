@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage News')
@section('header', 'News & Articles')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">News Library</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Manage department news, announcements, and research updates.</p>
    </div>
    <a href="{{ route('admin.news.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.9rem; transition: background 0.2s; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);">
        <i class="fa-solid fa-pen-nib"></i> Write Article
    </a>
</div>

<div data-aos="fade-up" class="admin-card" style="padding: 0; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Article Details</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Engagement</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $article)
            <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.2rem 1.5rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/'.$article->featured_image) }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        @else
                            <div style="width: 80px; height: 60px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #cbd5e1; border: 1px dashed #e2e8f0;">
                                <i class="fa-regular fa-image" style="font-size: 1.25rem;"></i>
                            </div>
                        @endif
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                                <a href="{{ route('admin.news.edit', $article) }}" style="color: #0f172a; font-weight: 600; font-size: 1rem; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='#0f172a'">
                                    {{ Str::limit($article->title, 65) }}
                                </a>
                                @if($article->is_featured)
                                    <span title="Featured Article" style="color: #eab308; font-size: 0.85rem;"><i class="fa-solid fa-star"></i></span>
                                @endif
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.8rem; color: #64748b; margin-top: 0.4rem;">
                                <span style="background: #e0f2fe; color: #3b82f6; padding: 0.15rem 0.6rem; border-radius: 12px; font-weight: 500; font-size: 0.7rem; text-transform: uppercase;">{{ $article->category }}</span>
                                <span style="display:flex; align-items:center; gap:0.25rem;"><i class="fa-regular fa-calendar"></i> {{ $article->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    @if($article->published_at && $article->published_at <= now())
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #ecfdf5; color: #0369a1; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #bae6fd;">
                            <div style="width: 6px; height: 6px; background: #0ea5e9; border-radius: 50%;"></div>
                            Published
                        </div>
                    @elseif($article->published_at && $article->published_at > now())
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #fffbeb; color: #b45309; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #fde68a;">
                            <i class="fa-regular fa-clock" style="font-size: 0.75rem;"></i>
                            Scheduled
                        </div>
                    @else
                        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #f1f5f9; color: #64748b; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                            <i class="fa-solid fa-pen" style="font-size: 0.75rem;"></i>
                            Draft
                        </div>
                    @endif
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle;">
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <div title="Reactions" style="display: flex; flex-direction: column; align-items: center;">
                            <span style="font-size: 0.95rem; font-weight: 600; color: #334155;">{{ $article->reactions_count ?? 0 }}</span>
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase;">Likes</span>
                        </div>
                        <div style="width: 1px; height: 24px; background: #e2e8f0;"></div>
                        <div title="Comments" style="display: flex; flex-direction: column; align-items: center;">
                            <span style="font-size: 0.95rem; font-weight: 600; color: #334155;">{{ $article->comments_count ?? 0 }}</span>
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase;">Cmts</span>
                        </div>
                    </div>
                </td>
                <td style="padding: 1.2rem 1.5rem; vertical-align: middle; text-align: right;">
                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                        <a href="{{ route('admin.news.edit', $article) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #475569; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'" title="Edit Article">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST" data-confirm="Are you sure you want to delete this article?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Article">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fa-regular fa-folder-open" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                    <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No articles found</h3>
                    <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">Your workspace is empty. Start by publishing department news.</p>
                    <a href="{{ route('admin.news.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
                        Write First Article
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($news->hasPages())
    <div style="padding: 1rem 1.5rem; background: #f8fafc; border-top: 1px solid #e2e8f0;">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
