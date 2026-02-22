@extends('layouts.public')
@section('title', $article->title)

@section('content')
<!-- Hero Section -->
<div style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(4, 120, 87, 0.9) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $article->featured_image ? asset('storage/'.$article->featured_image) : asset('images/campus-bg.jpg') }}') center/cover; padding: 5rem 0 6rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 80% 80%, rgba(16,185,129,0.15), transparent 50%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 10; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-regular fa-newspaper" style="font-size: 0.7rem;"></i> {{ $article->category }}
        </div>
        <h1 style="color: white; font-size: clamp(1.8rem, 4vw, 2.8rem); font-family: var(--font-heading); margin: 0 auto 1.2rem; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3); max-width: 800px; line-height: 1.3;">{{ $article->title }}</h1>
        <div style="display: flex; justify-content: center; align-items: center; gap: 1.5rem; flex-wrap: wrap; color: #94a3b8; font-size: 0.9rem;">
            <span><i class="fa-regular fa-calendar" style="margin-right: 5px;"></i>{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
            @if($article->author)
            <span><i class="fa-solid fa-user-pen" style="margin-right: 5px;"></i>{{ $article->author->name }}</span>
            @endif
        </div>
    </div>
</div>

<div class="container reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 5rem;">
    <div style="display: grid; grid-template-columns: 1fr 320px; gap: 2rem; align-items: start;" class="news-grid">

        {{-- ── Main Article ── --}}
        <article style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); overflow: hidden;">

            @if($article->featured_image)
            <img src="{{ asset('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" style="width: 100%; max-height: 420px; object-fit: cover;">
            @endif

            <div style="padding: 2.5rem 3rem;">
                {{-- Back link --}}
                <a href="{{ route('research-news') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.9rem; font-weight: 600; text-decoration: none; margin-bottom: 2rem; transition: color 0.2s;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='#64748b'">
                    <i class="fa-solid fa-arrow-left" style="font-size: 0.8rem;"></i> Back to News &amp; Events
                </a>

                {{-- Article Body --}}
                <div class="article-body" style="font-size: 1.05rem; line-height: 1.85; color: #334155;">
                    {!! nl2br(e($article->body)) !!}
                </div>

                {{-- Reactions --}}
                <div id="reactions-bar" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #f1f5f9;">
                    <span style="font-weight: 700; color: #475569; font-size: 0.9rem; display: block; margin-bottom: 0.8rem;">How do you feel about this article?</span>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                        @php
                            $reactionEmojis = [
                                'like'        => ['emoji' => '👍', 'label' => 'Like'],
                                'love'        => ['emoji' => '❤️', 'label' => 'Love'],
                                'clap'        => ['emoji' => '👏', 'label' => 'Clap'],
                                'insightful'  => ['emoji' => '💡', 'label' => 'Insightful'],
                                'celebrate'   => ['emoji' => '🎉', 'label' => 'Celebrate'],
                            ];
                        @endphp
                        @foreach($reactionEmojis as $type => $info)
                        <button
                            type="button"
                            class="reaction-btn"
                            data-type="{{ $type }}"
                            style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.45rem 0.9rem; border: 1.5px solid #e2e8f0; border-radius: 999px; background: white; cursor: pointer; font-size: 0.95rem; color: #64748b; font-weight: 600; transition: all 0.2s ease;"
                            onmouseover="if(!this.classList.contains('active')){this.style.borderColor='var(--color-primary)';this.style.background='#f0fdf4'}"
                            onmouseout="if(!this.classList.contains('active')){this.style.borderColor='#e2e8f0';this.style.background='white'}"
                        >
                            <span style="font-size: 1.15rem;">{{ $info['emoji'] }}</span>
                            <span class="reaction-label">{{ $info['label'] }}</span>
                            <span class="reaction-count" data-type="{{ $type }}" style="font-size: 0.8rem; color: #94a3b8; min-width: 0;"></span>
                        </button>
                        @endforeach
                    </div>
                    <p id="reaction-total" style="font-size: 0.82rem; color: #94a3b8; margin-top: 0.6rem;"></p>
                </div>

                {{-- Share --}}
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                    <span style="font-weight: 700; color: #475569; font-size: 0.9rem;">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #eff6ff; color: #1d4ed8; text-decoration: none; font-size: 1rem; transition: background 0.2s;" onmouseover="this.style.background='#1d4ed8';this.style.color='white'" onmouseout="this.style.background='#eff6ff';this.style.color='#1d4ed8'"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f0f9ff; color: #0369a1; text-decoration: none; font-size: 1rem; transition: background 0.2s;" onmouseover="this.style.background='#0369a1';this.style.color='white'" onmouseout="this.style.background='#f0f9ff';this.style.color='#0369a1'"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}" target="_blank" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f0fdf4; color: #15803d; text-decoration: none; font-size: 1rem; transition: background 0.2s;" onmouseover="this.style.background='#15803d';this.style.color='white'" onmouseout="this.style.background='#f0fdf4';this.style.color='#15803d'"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
        </article>

        {{-- ── Sidebar ── --}}
        <aside style="display: flex; flex-direction: column; gap: 1.5rem; position: sticky; top: 2rem;">

            {{-- Category badge --}}
            <div style="background: white; border-radius: 14px; padding: 1.5rem; box-shadow: 0 4px 15px -5px rgba(0,0,0,0.08);">
                <h3 style="margin: 0 0 1rem; font-size: 1rem; font-family: var(--font-heading); color: #0f172a;">Article Details</h3>
                <div style="display: flex; flex-direction: column; gap: 0.8rem; font-size: 0.9rem; color: #64748b;">
                    <div style="display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-tag" style="color: var(--color-primary); width: 16px;"></i><span>{{ $article->category }}</span></div>
                    <div style="display: flex; align-items: center; gap: 0.6rem;"><i class="fa-regular fa-calendar" style="color: var(--color-primary); width: 16px;"></i><span>{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('F j, Y') : $article->created_at->format('F j, Y') }}</span></div>
                    @if($article->author)
                    <div style="display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-user" style="color: var(--color-primary); width: 16px;"></i><span>{{ $article->author->name }}</span></div>
                    @endif
                </div>
            </div>

            {{-- Related news --}}
            @if($related->isNotEmpty())
            <div style="background: white; border-radius: 14px; padding: 1.5rem; box-shadow: 0 4px 15px -5px rgba(0,0,0,0.08);">
                <h3 style="margin: 0 0 1.2rem; font-size: 1rem; font-family: var(--font-heading); color: #0f172a;">More News</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($related as $rel)
                    <a href="{{ route('research-news.show', $rel->slug) }}" style="display: flex; gap: 0.8rem; text-decoration: none; align-items: flex-start; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.75'" onmouseout="this.style.opacity='1'">
                        @if($rel->featured_image)
                        <img src="{{ asset('storage/'.$rel->featured_image) }}" alt="" style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px; flex-shrink: 0;">
                        @else
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; color: #94a3b8;"><i class="fa-regular fa-image"></i></div>
                        @endif
                        <div>
                            <p style="margin: 0 0 0.3rem; font-size: 0.9rem; font-weight: 600; color: #1e293b; line-height: 1.4;">{{ Str::limit($rel->title, 60) }}</p>
                            <span style="font-size: 0.8rem; color: #94a3b8;">{{ $rel->published_at ? \Carbon\Carbon::parse($rel->published_at)->format('M d, Y') : $rel->created_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </aside>
    </div>
</div>

<style>
    .article-body p { margin-bottom: 1.2rem; }
    .article-body h2, .article-body h3 { font-family: var(--font-heading); color: #0f172a; margin: 2rem 0 1rem; }
    .article-body a { color: var(--color-primary); }
    .article-body img { max-width: 100%; border-radius: 10px; margin: 1.5rem 0; }
    .reaction-btn.active {
        border-color: var(--color-primary) !important;
        background: #ecfdf5 !important;
        color: #047857 !important;
    }
    .reaction-btn.active .reaction-count { color: #047857 !important; }
    .reaction-btn:active { transform: scale(0.93); }
    @media (max-width: 900px) {
        .news-grid { grid-template-columns: 1fr !important; }
        aside { position: static !important; }
    }
    @media (max-width: 600px) {
        article > div:last-child { padding: 1.5rem 1.2rem !important; }
        .reaction-label { display: none; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const newsId = @json($article->id);
    const getUrl  = @json(route('reactions.show', $article->id));
    const postUrl = @json(route('reactions.store', $article->id));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    function updateUI(data) {
        document.querySelectorAll('.reaction-btn').forEach(btn => {
            const type = btn.dataset.type;
            const countEl = btn.querySelector('.reaction-count');
            const count = (data.counts && data.counts[type]) || 0;
            countEl.textContent = count > 0 ? count : '';

            if (data.user_reaction === type) {
                btn.classList.add('active');
                btn.style.borderColor = 'var(--color-primary)';
                btn.style.background = '#ecfdf5';
            } else {
                btn.classList.remove('active');
                btn.style.borderColor = '#e2e8f0';
                btn.style.background = 'white';
            }
        });

        const totalEl = document.getElementById('reaction-total');
        if (data.total > 0) {
            totalEl.textContent = data.total + ' reaction' + (data.total !== 1 ? 's' : '') + ' on this article';
        } else {
            totalEl.textContent = 'Be the first to react!';
        }
    }

    // Load initial state
    fetch(getUrl, { credentials: 'same-origin' })
        .then(r => r.json())
        .then(updateUI)
        .catch(() => {});

    // Handle clicks
    document.querySelectorAll('.reaction-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const type = this.dataset.type;
            fetch(postUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ type: type }),
            })
            .then(r => r.json())
            .then(updateUI)
            .catch(() => {});
        });
    });
});
</script>
@endsection
