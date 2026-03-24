@extends('layouts.public')
@section('title', $article->title)

@section('content')
@php
    $publishDate = $article->published_at ? \Carbon\Carbon::parse($article->published_at) : $article->created_at;
    $readTime = max(1, ceil(str_word_count(strip_tags($article->body)) / 200));
@endphp

<style>
/* ── Hero ── */
.nd-hero {
    position: relative;
    background: linear-gradient(160deg, #0f172a 0%, #1e293b 100%);
    overflow: hidden;
    min-height: 340px;
}
.nd-hero-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.18;
    filter: blur(2px);
    transition: opacity 0.6s;
}
.nd-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15,23,42,0.5) 0%, rgba(15,23,42,0.95) 100%);
}
.nd-hero-inner {
    position: relative;
    z-index: 5;
    max-width: 780px;
    margin: 0 auto;
    padding: 4.5rem 1.5rem 5.5rem;
    text-align: center;
}
.nd-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    color: #94a3b8;
    font-size: 0.82rem;
    margin-bottom: 1.5rem;
    text-decoration: none;
    transition: color 0.2s;
}
.nd-breadcrumb:hover { color: #e2e8f0; }
.nd-breadcrumb i { font-size: 0.7rem; }
.nd-category-pill {
    display: inline-block;
    padding: 0.3rem 1rem;
    background: rgba(var(--color-primary-rgb, 22,163,106), 0.15);
    border: 1px solid rgba(var(--color-primary-rgb, 22,163,106), 0.25);
    color: #6ee7b7;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.nd-hero-title {
    color: #fff;
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 4vw, 2.6rem);
    font-weight: 800;
    line-height: 1.28;
    margin: 0 0 1.3rem;
    letter-spacing: -0.02em;
}
.nd-hero-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.2rem;
    flex-wrap: wrap;
    color: #94a3b8;
    font-size: 0.85rem;
}
.nd-hero-meta span {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}
.nd-hero-meta .nd-dot {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: #475569;
    display: inline-block;
}

/* ── Layout ── */
.nd-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2.2rem;
    align-items: start;
    max-width: 1100px;
    margin: -3rem auto 0;
    padding: 0 1.5rem 4rem;
    position: relative;
    z-index: 10;
}

/* ── Article Card ── */
.nd-article {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 40px -10px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.04);
    overflow: hidden;
}
.nd-featured-img {
    width: 100%;
    max-height: 440px;
    object-fit: cover;
    display: block;
}
.nd-article-body-wrap {
    padding: 2.5rem 2.8rem 2rem;
}
.nd-article-body {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #334155;
}
.nd-article-body p { margin-bottom: 1.2rem; }
.nd-article-body h2, .nd-article-body h3 { font-family: var(--font-heading); color: #0f172a; margin: 2rem 0 0.8rem; }
.nd-article-body a { color: var(--color-primary); text-decoration: underline; text-decoration-color: rgba(var(--color-primary-rgb,22,163,106),0.3); transition: text-decoration-color 0.2s; }
.nd-article-body a:hover { text-decoration-color: var(--color-primary); }
.nd-article-body img { max-width: 100%; border-radius: 12px; margin: 1.5rem 0; }
.nd-article-body blockquote { border-left: 3px solid var(--color-primary); padding: 0.8rem 1.2rem; margin: 1.5rem 0; background: #f8fafc; border-radius: 0 10px 10px 0; color: #475569; font-style: italic; }

/* ── Divider ── */
.nd-divider {
    border: none;
    border-top: 1px solid #f1f5f9;
    margin: 2rem 0;
}

/* ── Engage Bar (Share left, Reactions right) ── */
.nd-engage-bar {
    padding: 0 2.8rem 2rem;
}
.nd-engage-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.nd-share-trigger {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.5rem 1.1rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 999px;
    background: #fff;
    color: #475569;
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
}
.nd-share-trigger:hover { border-color: var(--color-primary); color: var(--color-primary); background: #f0fdf4; }
.nd-share-trigger i { font-size: 0.9rem; }
.nd-reactions-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.nd-reaction-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    width: 42px;
    height: 42px;
    border: 1.5px solid #e2e8f0;
    border-radius: 50%;
    background: #fff;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.2s cubic-bezier(.4,0,.2,1);
    position: relative;
    padding: 0;
}
.nd-reaction-btn:hover {
    border-color: var(--color-primary);
    background: #f0fdf4;
    transform: scale(1.15);
}
.nd-reaction-btn:active { transform: scale(0.9); }
.nd-reaction-btn.active {
    border-color: var(--color-primary);
    background: #ecfdf5;
    box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb,22,163,106),0.12);
}
.nd-reaction-btn .nd-rcount {
    position: absolute;
    top: -6px;
    right: -6px;
    background: var(--color-primary);
    color: #fff;
    font-size: 0.65rem;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    border-radius: 999px;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    line-height: 1;
    box-shadow: 0 2px 4px rgba(0,0,0,0.15);
}
.nd-reaction-btn .nd-rcount.has-count { display: flex; }
.nd-reaction-total {
    font-size: 0.82rem;
    color: #94a3b8;
    margin: 0.5rem 0 0;
    text-align: right;
}

/* ── Share Modal ── */
.nd-share-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,0.6);
    backdrop-filter: blur(6px);
    z-index: 9998;
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.nd-share-overlay.open { display: flex; opacity: 1; }
.nd-share-modal {
    background: #fff;
    border-radius: 22px;
    width: 420px;
    max-width: 92vw;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 80px -12px rgba(0,0,0,0.3), 0 0 0 1px rgba(0,0,0,0.04);
    animation: ndModalIn 0.35s cubic-bezier(.21,1.02,.73,1);
}
@keyframes ndModalIn {
    from { opacity: 0; transform: scale(0.88) translateY(20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.nd-share-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.1rem 1.4rem;
    border-bottom: 1px solid #f1f5f9;
}
.nd-share-modal-header h4 {
    margin: 0;
    font-size: 1.05rem;
    font-family: var(--font-heading);
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.45rem;
}
.nd-share-modal-header h4 i { color: var(--color-primary); font-size: 1.1rem; }
.nd-share-close {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: #f1f5f9;
    color: #64748b;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    transition: all 0.2s;
}
.nd-share-close:hover { background: #fee2e2; color: #dc2626; transform: rotate(90deg); }

/* Share card preview – image with overlay */
.nd-share-card-wrap {
    padding: 1.2rem 1.4rem 0.8rem;
}
.nd-share-card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 24px -6px rgba(0,0,0,0.14);
    background: #fff;
    position: relative;
}
.nd-share-card-visual {
    position: relative;
    width: 100%;
    height: 210px;
    overflow: hidden;
}
.nd-share-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.nd-share-card-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #cbd5e1;
    font-size: 2.5rem;
}
.nd-share-card-visual::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.0) 60%);
    pointer-events: none;
}
.nd-share-card-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 2;
    padding: 1rem 1.1rem 0.9rem;
}
.nd-share-card-cat {
    display: inline-block;
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: #6ee7b7;
    background: rgba(0,0,0,0.25);
    padding: 0.2rem 0.6rem;
    border-radius: 4px;
    margin-bottom: 0.35rem;
}
.nd-share-card-title {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 800;
    color: #fff;
    font-family: var(--font-heading);
    line-height: 1.32;
    text-shadow: 0 1px 4px rgba(0,0,0,0.3);
}
.nd-share-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.7rem 1.1rem;
    background: #fafbfc;
    border-top: 1px solid #f1f5f9;
}
.nd-share-card-meta {
    font-size: 0.78rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}
.nd-share-card-meta i { color: #94a3b8; }
.nd-share-card-brand {
    font-size: 0.68rem;
    font-weight: 700;
    color: #cbd5e1;
    letter-spacing: 0.5px;
}

/* URL bar */
.nd-url-bar {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0.6rem 1.4rem 0;
    padding: 0.5rem 0.7rem;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    transition: border-color 0.2s;
}
.nd-url-bar:hover { border-color: #cbd5e1; }
.nd-url-bar i { color: #94a3b8; font-size: 0.8rem; flex-shrink: 0; }
.nd-url-text {
    flex: 1;
    font-size: 0.78rem;
    color: #64748b;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    min-width: 0;
}
.nd-url-copy {
    flex-shrink: 0;
    padding: 0.3rem 0.7rem;
    border: none;
    background: var(--color-primary);
    color: #fff;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.72rem;
    cursor: pointer;
    transition: all 0.2s;
}
.nd-url-copy:hover { opacity: 0.9; }
.nd-url-copy.copied { background: #047857; }

/* Share actions */
.nd-share-actions {
    padding: 1rem 1.4rem 1.3rem;
}
.nd-share-section-label {
    font-size: 0.72rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.7rem;
}
.nd-share-platforms {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}
.nd-sp-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.3rem;
    text-decoration: none;
    cursor: pointer;
    border: none;
    background: none;
    padding: 0.35rem 0.5rem;
    transition: transform 0.2s;
    border-radius: 12px;
}
.nd-sp-btn:hover { transform: translateY(-3px); background: #f8fafc; }
.nd-sp-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #fff;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.nd-sp-btn:hover .nd-sp-icon { box-shadow: 0 6px 18px rgba(0,0,0,0.18); transform: scale(1.06); }
.nd-sp-label {
    font-size: 0.68rem;
    font-weight: 600;
    color: #64748b;
}
.nd-sp-fb { background: linear-gradient(135deg, #1877f2, #0d5ec7); }
.nd-sp-tw { background: linear-gradient(135deg, #14171a, #333); }
.nd-sp-wa { background: linear-gradient(135deg, #25d366, #128c7e); }
.nd-sp-li { background: linear-gradient(135deg, #0a66c2, #004182); }
.nd-sp-tg { background: linear-gradient(135deg, #26a5e4, #0088cc); }
.nd-sp-em { background: linear-gradient(135deg, #ea580c, #c2410c); }

.nd-share-divider {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    margin: 0.9rem 0;
    font-size: 0.72rem;
    color: #cbd5e1;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.nd-share-divider::before, .nd-share-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
}
.nd-sp-dl-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.65rem 1rem;
    background: linear-gradient(135deg, var(--color-primary), #047857);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(var(--color-primary-rgb,22,163,106),0.3);
}
.nd-sp-dl-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(var(--color-primary-rgb,22,163,106),0.4); }
.nd-sp-dl-btn:active { transform: scale(0.98); }
.nd-sp-dl-btn i { font-size: 0.85rem; }

/* ── Comments ── */
.nd-comments-wrap {
    padding: 0 2.8rem 2.5rem;
}
.nd-comments-header {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    margin-bottom: 1.5rem;
}
.nd-comments-header h3 {
    margin: 0;
    font-size: 1.05rem;
    font-family: var(--font-heading);
    color: #0f172a;
}
.nd-count-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--color-primary);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    min-width: 22px;
    height: 22px;
    border-radius: 999px;
    padding: 0 6px;
}
.nd-comment-form {
    background: #f8fafc;
    border-radius: 14px;
    padding: 1.2rem 1.3rem;
    margin-bottom: 1.8rem;
    border: 1px solid #f1f5f9;
}
.nd-cform-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.6rem;
    margin-bottom: 0.6rem;
}
.nd-cform-input {
    padding: 0.55rem 0.85rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.85rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fff;
    font-family: inherit;
}
.nd-cform-input:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb,22,163,106),0.08);
}
.nd-cform-textarea {
    width: 100%;
    padding: 0.65rem 0.85rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.88rem;
    font-family: inherit;
    resize: vertical;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fff;
    min-height: 72px;
    box-sizing: border-box;
}
.nd-cform-textarea:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb,22,163,106),0.08);
}
.nd-cform-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 0.6rem;
    gap: 0.5rem;
}
.nd-cform-hint {
    font-size: 0.75rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}
.nd-cform-submit {
    padding: 0.5rem 1.2rem;
    background: var(--color-primary);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.35rem;
    transition: all 0.2s;
    white-space: nowrap;
}
.nd-cform-submit:hover { opacity: 0.9; box-shadow: 0 4px 12px rgba(var(--color-primary-rgb,22,163,106),0.25); }
.nd-cform-alert {
    display: none;
    margin-top: 0.5rem;
    padding: 0.45rem 0.7rem;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 500;
}

/* Comment items */
.nd-c-item {
    display: flex;
    gap: 0.75rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    animation: ndFadeIn 0.35s ease;
}
.nd-c-item:last-child { border-bottom: none; }
@keyframes ndFadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}
.nd-c-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #f1f5f9;
    border: 1.5px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #94a3b8;
    font-size: 1rem;
}
.nd-c-body { flex: 1; min-width: 0; }
.nd-c-meta {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    margin-bottom: 0.25rem;
    flex-wrap: wrap;
}
.nd-c-author { font-weight: 700; font-size: 0.85rem; color: #1e293b; }
.nd-c-you { font-size: 0.65rem; padding: 0.1rem 0.4rem; background: #ecfdf5; color: #047857; border-radius: 4px; font-weight: 700; }
.nd-c-time { font-size: 0.76rem; color: #94a3b8; }
.nd-c-text { font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0; word-wrap: break-word; }
.nd-c-actions { margin-top: 0.35rem; }
.nd-c-reply-btn {
    background: none;
    border: none;
    font-size: 0.76rem;
    color: #94a3b8;
    cursor: pointer;
    font-weight: 600;
    padding: 0;
    transition: color 0.2s;
}
.nd-c-reply-btn:hover { color: var(--color-primary); }
.nd-c-replies { margin-left: 2.5rem; }
.nd-c-replies .nd-c-item { padding: 0.7rem 0; }
.nd-c-replies .nd-c-avatar { width: 30px; height: 30px; font-size: 0.8rem; }
.nd-inline-reply {
    margin: 0.4rem 0 0 2.5rem;
    display: flex;
    gap: 0.4rem;
    align-items: flex-start;
}
.nd-inline-reply textarea {
    flex: 1;
    padding: 0.45rem 0.7rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.82rem;
    font-family: inherit;
    resize: none;
    outline: none;
    min-height: 36px;
    transition: border-color 0.2s;
    background: #f8fafc;
}
.nd-inline-reply textarea:focus { border-color: var(--color-primary); background: #fff; }
.nd-inline-reply button {
    padding: 0.45rem 0.8rem;
    background: var(--color-primary);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.78rem;
    cursor: pointer;
    white-space: nowrap;
}

.nd-comments-empty {
    display: none;
    text-align: center;
    padding: 2rem 1rem;
}
.nd-load-more {
    display: none;
    text-align: center;
    margin-top: 1rem;
}
.nd-load-more button {
    padding: 0.45rem 1.3rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    background: #fff;
    color: #475569;
    font-weight: 600;
    font-size: 0.82rem;
    cursor: pointer;
    transition: all 0.2s;
}
.nd-load-more button:hover { border-color: var(--color-primary); color: var(--color-primary); }

/* ── Sidebar ── */
.nd-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    position: sticky;
    top: 7rem;
}
.nd-sidebar-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.4rem;
    box-shadow: 0 4px 20px -6px rgba(0,0,0,0.07);
    border: 1px solid #f1f5f9;
}
.nd-sidebar-card h4 {
    margin: 0 0 1rem;
    font-size: 0.92rem;
    font-family: var(--font-heading);
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.nd-sidebar-card h4 i { color: var(--color-primary); font-size: 0.85rem; }
.nd-detail-row {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
    color: #64748b;
    padding: 0.5rem 0;
}
.nd-detail-row:not(:last-child) { border-bottom: 1px solid #f8fafc; }
.nd-detail-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: #f0fdf4;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.nd-detail-icon i { color: var(--color-primary); font-size: 0.78rem; }
.nd-related-item {
    display: flex;
    gap: 0.7rem;
    text-decoration: none;
    align-items: flex-start;
    padding: 0.6rem 0;
    border-bottom: 1px solid #f8fafc;
    transition: all 0.2s;
}
.nd-related-item:last-child { border-bottom: none; }
.nd-related-item:hover { opacity: 0.7; }
.nd-related-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
}
.nd-related-placeholder {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    border-radius: 10px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #cbd5e1;
}
.nd-related-info p {
    margin: 0 0 0.2rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.35;
}
.nd-related-info span {
    font-size: 0.78rem;
    color: #94a3b8;
}

/* ── Copy toast ── */
.nd-toast {
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: #1e293b;
    color: #fff;
    padding: 0.6rem 1.2rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 9999;
    opacity: 0;
    transition: all 0.3s;
    pointer-events: none;
}
.nd-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

/* ── Responsive ── */
@media (max-width: 900px) {
    .nd-layout { grid-template-columns: 1fr; }
    .nd-sidebar { position: static !important; }
}
@media (max-width: 600px) {
    .nd-article-body-wrap,
    .nd-engage-bar,
    .nd-comments-wrap { padding-left: 1.3rem; padding-right: 1.3rem; }
    .nd-hero-inner { padding: 3rem 1rem 4.5rem; }
    .nd-cform-row { grid-template-columns: 1fr; }
    .nd-c-replies { margin-left: 1.5rem; }
    .nd-inline-reply { margin-left: 1.5rem; }
    .nd-cform-footer { flex-direction: column; align-items: stretch; }
    .nd-cform-submit { justify-content: center; }
    .nd-reaction-btn { width: 38px; height: 38px; font-size: 1.05rem; }
    .nd-engage-row { flex-direction: column-reverse; align-items: stretch; }
    .nd-reactions-row { justify-content: center; }
    .nd-reaction-total { text-align: center; }
    .nd-share-trigger { justify-content: center; }
}
</style>

<!-- Hero -->
<div class="nd-hero">
    <div class="nd-hero-bg" style="background-image: url('{{ $article->featured_image ? asset('storage/'.$article->featured_image) : asset('images/campus-bg.jpg') }}');"></div>
    <div class="nd-hero-overlay"></div>
    <div class="nd-hero-inner">
        <a href="{{ route('research-news') }}" class="nd-breadcrumb">
            <i class="fa-solid fa-arrow-left"></i> Back to News & Events
        </a>
        <div class="nd-category-pill">{{ $article->category }}</div>
        <h1 class="nd-hero-title">{{ $article->title }}</h1>
        <div class="nd-hero-meta">
            <span><i class="fa-regular fa-calendar"></i> {{ $publishDate->format('M d, Y') }}</span>
            <span class="nd-dot"></span>
            <span><i class="fa-regular fa-clock"></i> {{ $readTime }} min read</span>
            @if($article->author)
            <span class="nd-dot"></span>
            <span><i class="fa-regular fa-user"></i> {{ $article->author->name }}</span>
            @endif
        </div>
    </div>
</div>

<!-- Layout -->
<div class="nd-layout">
    <!-- Article -->
    <div>
        <article class="nd-article">
            @if($article->featured_image)
            <img src="{{ asset('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" class="nd-featured-img">
            @endif

            <div class="nd-article-body-wrap">
                <div class="nd-article-body">
                    {!! nl2br(e($article->body)) !!}
                </div>
            </div>

            <!-- Reactions + Share -->
            <div class="nd-engage-bar">
                <hr class="nd-divider">
                <div class="nd-engage-row">
                    <button type="button" class="nd-share-trigger" onclick="openShareModal()">
                        <i class="fa-solid fa-share-nodes"></i> Share
                    </button>
                    <div>
                        <div class="nd-reactions-row" id="reactions-bar">
                            @php
                                $reactions = [
                                    'like'       => '👍',
                                    'love'       => '❤️',
                                    'clap'       => '👏',
                                    'insightful' => '💡',
                                    'celebrate'  => '🎉',
                                ];
                            @endphp
                            @foreach($reactions as $type => $emoji)
                            <button type="button" class="nd-reaction-btn" data-type="{{ $type }}" title="{{ ucfirst($type) }}">
                                <span>{{ $emoji }}</span>
                                <span class="nd-rcount" data-type="{{ $type }}"></span>
                            </button>
                            @endforeach
                        </div>
                        <p class="nd-reaction-total" id="reaction-total"></p>
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <div class="nd-comments-wrap">
                <hr class="nd-divider">
                <div class="nd-comments-header">
                    <i class="fa-regular fa-comments" style="color: var(--color-primary); font-size: 1.1rem;"></i>
                    <h3>Comments</h3>
                    <span class="nd-count-pill" id="comment-count-badge">0</span>
                </div>

                <div class="nd-comment-form">
                    <form id="comment-form" onsubmit="submitComment(event)">
                        <div class="nd-cform-row">
                            <input type="text" id="comment-name" placeholder="Name (optional)" maxlength="100" class="nd-cform-input">
                            <input type="email" id="comment-email" placeholder="Email (optional, not shown)" maxlength="150" class="nd-cform-input">
                        </div>
                        <textarea id="comment-body" rows="3" placeholder="Share your thoughts..." maxlength="2000" required class="nd-cform-textarea"></textarea>
                        <div class="nd-cform-footer">
                            <span class="nd-cform-hint"><i class="fa-solid fa-shield-halved"></i> No login required</span>
                            <button type="submit" id="comment-submit-btn" class="nd-cform-submit">
                                <i class="fa-solid fa-paper-plane" style="font-size: 0.78rem;"></i> Post Comment
                            </button>
                        </div>
                        <div id="comment-form-alert" class="nd-cform-alert"></div>
                    </form>
                </div>

                <div id="comments-list">
                    <div id="comments-loading" style="text-align: center; padding: 1.5rem; color: #94a3b8; font-size: 0.88rem;">
                        <i class="fa-solid fa-spinner fa-spin"></i> Loading comments...
                    </div>
                </div>

                <div id="comments-empty" class="nd-comments-empty">
                    <i class="fa-regular fa-comment-dots" style="font-size: 2rem; color: #e2e8f0; display: block; margin-bottom: 0.6rem;"></i>
                    <p style="color: #94a3b8; font-size: 0.88rem; margin: 0;">No comments yet. Be the first to share your thoughts!</p>
                </div>

                <div id="comments-load-more" class="nd-load-more">
                    <button type="button" onclick="loadMoreComments()"><i class="fa-solid fa-chevron-down" style="margin-right: 0.3rem;"></i> Load more</button>
                </div>
            </div>
        </article>
    </div>

    <!-- Sidebar -->
    <aside class="nd-sidebar">
        <div class="nd-sidebar-card">
            <h4><i class="fa-solid fa-circle-info"></i> Article Details</h4>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-solid fa-tag"></i></div>
                <span>{{ $article->category }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-calendar"></i></div>
                <span>{{ $publishDate->format('F j, Y') }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-clock"></i></div>
                <span>{{ $readTime }} min read</span>
            </div>
            @if($article->author)
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-solid fa-user-pen"></i></div>
                <span>{{ $article->author->name }}</span>
            </div>
            @endif
        </div>

        @if($related->isNotEmpty())
        <div class="nd-sidebar-card">
            <h4><i class="fa-solid fa-newspaper"></i> Related News</h4>
            @foreach($related as $rel)
            <a href="{{ route('research-news.show', $rel->slug) }}" class="nd-related-item">
                @if($rel->featured_image)
                <img src="{{ asset('storage/'.$rel->featured_image) }}" alt="" class="nd-related-img">
                @else
                <div class="nd-related-placeholder"><i class="fa-regular fa-image"></i></div>
                @endif
                <div class="nd-related-info">
                    <p>{{ Str::limit($rel->title, 55) }}</p>
                    <span>{{ $rel->published_at ? \Carbon\Carbon::parse($rel->published_at)->format('M d, Y') : $rel->created_at->format('M d, Y') }}</span>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </aside>
</div>

<!-- Share Modal -->
<div class="nd-share-overlay" id="share-overlay" onclick="if(event.target===this)closeShareModal()">
    <div class="nd-share-modal">
        <div class="nd-share-modal-header">
            <h4><i class="fa-solid fa-share-nodes"></i> Share this article</h4>
            <button class="nd-share-close" onclick="closeShareModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <!-- Card preview with overlay text -->
        <div class="nd-share-card-wrap">
            <div class="nd-share-card" id="share-card">
                <div class="nd-share-card-visual">
                    @if($article->featured_image)
                    <img src="{{ asset('storage/'.$article->featured_image) }}" alt="" class="nd-share-card-img">
                    @else
                    <div class="nd-share-card-placeholder"><i class="fa-regular fa-newspaper"></i></div>
                    @endif
                    <div class="nd-share-card-overlay">
                        <div class="nd-share-card-cat">{{ $article->category }}</div>
                        <h3 class="nd-share-card-title">{{ $article->title }}</h3>
                    </div>
                </div>
                <div class="nd-share-card-footer">
                    <div class="nd-share-card-meta">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $publishDate->format('M d, Y') }}
                        @if($article->author)
                         &middot; {{ $article->author->name }}
                        @endif
                    </div>
                    <span class="nd-share-card-brand">DCMS</span>
                </div>
            </div>
        </div>

        <!-- URL copy bar -->
        <div class="nd-url-bar">
            <i class="fa-solid fa-link"></i>
            <span class="nd-url-text">{{ request()->url() }}</span>
            <button type="button" class="nd-url-copy" id="url-copy-btn" onclick="copyUrlBar()">
                <i class="fa-regular fa-copy" style="margin-right:2px;"></i> Copy
            </button>
        </div>

        <!-- Social platforms -->
        <div class="nd-share-actions">
            <div class="nd-share-section-label">Share to</div>
            <div class="nd-share-platforms">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-fb"><i class="fa-brands fa-facebook-f"></i></div>
                    <span class="nd-sp-label">Facebook</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-tw"><i class="fa-brands fa-x-twitter"></i></div>
                    <span class="nd-sp-label">X</span>
                </a>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}" target="_blank" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-wa"><i class="fa-brands fa-whatsapp"></i></div>
                    <span class="nd-sp-label">WhatsApp</span>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-li"><i class="fa-brands fa-linkedin-in"></i></div>
                    <span class="nd-sp-label">LinkedIn</span>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-tg"><i class="fa-brands fa-telegram"></i></div>
                    <span class="nd-sp-label">Telegram</span>
                </a>
                <a href="mailto:?subject={{ rawurlencode($article->title) }}&body={{ rawurlencode('Check out this article: ' . request()->url()) }}" class="nd-sp-btn">
                    <div class="nd-sp-icon nd-sp-em"><i class="fa-solid fa-envelope"></i></div>
                    <span class="nd-sp-label">Email</span>
                </a>
            </div>
            <div class="nd-share-divider"><span>save as image</span></div>
            <button type="button" class="nd-sp-dl-btn" onclick="downloadShareCard()">
                <i class="fa-solid fa-download"></i> Download Share Card
            </button>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="nd-toast" id="nd-toast"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    // ── Share Modal ──
    window.openShareModal = function() {
        const o = document.getElementById('share-overlay');
        o.style.display = 'flex';
        requestAnimationFrame(() => o.classList.add('open'));
        document.body.style.overflow = 'hidden';
    };
    window.closeShareModal = function() {
        const o = document.getElementById('share-overlay');
        o.classList.remove('open');
        setTimeout(() => { o.style.display = 'none'; }, 300);
        document.body.style.overflow = '';
    };
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeShareModal();
    });

    // ── Copy link ──
    window.copyArticleLink = function() {
        navigator.clipboard.writeText(window.location.href).then(() => showToast('Link copied!'));
    };
    window.copyUrlBar = function() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('url-copy-btn');
            btn.innerHTML = '<i class="fa-solid fa-check" style="margin-right:2px;"></i> Copied';
            btn.classList.add('copied');
            showToast('Link copied!');
            setTimeout(() => {
                btn.innerHTML = '<i class="fa-regular fa-copy" style="margin-right:2px;"></i> Copy';
                btn.classList.remove('copied');
            }, 2000);
        });
    };

    function showToast(msg) {
        const t = document.getElementById('nd-toast');
        t.textContent = msg;
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 2000);
    }

    // ── Download share card as image ──
    window.downloadShareCard = function() {
        const card = document.getElementById('share-card');
        const canvas = document.createElement('canvas');
        const W = 800, imgH = 420;
        const scale = 2;
        canvas.width = W * scale;
        const ctx = canvas.getContext('2d');

        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim() || '#16a34a';

        const drawCard = (imgObj) => {
            // Calculate total height
            ctx.save();
            ctx.scale(scale, scale);

            // White background
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, W, 800);

            // Draw image
            if (imgObj) {
                const iw = imgObj.naturalWidth, ih = imgObj.naturalHeight;
                const srcH = iw * (imgH / W);
                const srcY = Math.max(0, (ih - srcH) / 2);
                ctx.drawImage(imgObj, 0, srcY, iw, srcH, 0, 0, W, imgH);
            } else {
                ctx.fillStyle = '#e2e8f0';
                ctx.fillRect(0, 0, W, imgH);
            }

            // Gradient overlay on image
            const grad = ctx.createLinearGradient(0, imgH * 0.3, 0, imgH);
            grad.addColorStop(0, 'rgba(0,0,0,0)');
            grad.addColorStop(1, 'rgba(0,0,0,0.6)');
            ctx.fillStyle = grad;
            ctx.fillRect(0, 0, W, imgH);

            // Category badge on image
            const cat = card.querySelector('.nd-share-card-cat').textContent.trim();
            ctx.font = 'bold 13px sans-serif';
            const catW = ctx.measureText(cat).width + 16;
            const catX = 24, catY = imgH - 62;
            ctx.fillStyle = 'rgba(0,0,0,0.3)';
            roundRect(ctx, catX, catY - 14, catW, 22, 4);
            ctx.fill();
            ctx.fillStyle = '#6ee7b7';
            ctx.fillText(cat, catX + 8, catY + 2);

            // Title on image
            ctx.font = 'bold 24px sans-serif';
            ctx.fillStyle = '#fff';
            wrapText(ctx, card.querySelector('.nd-share-card-title').textContent.trim(), 24, imgH - 28, W - 48, 30);

            // Footer bar
            const footerY = imgH;
            ctx.fillStyle = '#fafbfc';
            ctx.fillRect(0, footerY, W, 50);
            ctx.fillStyle = '#f1f5f9';
            ctx.fillRect(0, footerY, W, 1);

            // Date + author
            ctx.font = '13px sans-serif';
            ctx.fillStyle = '#64748b';
            const meta = card.querySelector('.nd-share-card-meta').textContent.trim();
            ctx.fillText(meta, 24, footerY + 30);

            // Brand
            ctx.font = 'bold 12px sans-serif';
            ctx.fillStyle = '#cbd5e1';
            const brand = 'DCMS';
            ctx.fillText(brand, W - ctx.measureText(brand).width - 24, footerY + 30);

            // Bottom accent line
            ctx.fillStyle = primaryColor;
            ctx.fillRect(0, footerY + 50, W, 4);

            // Trim canvas
            const totalH = footerY + 54;
            canvas.height = totalH * scale;
            ctx.restore();

            // Redraw at correct canvas height
            ctx.save();
            ctx.scale(scale, scale);
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, W, totalH);

            if (imgObj) {
                const iw2 = imgObj.naturalWidth, ih2 = imgObj.naturalHeight;
                const srcH2 = iw2 * (imgH / W);
                const srcY2 = Math.max(0, (ih2 - srcH2) / 2);
                ctx.drawImage(imgObj, 0, srcY2, iw2, srcH2, 0, 0, W, imgH);
            } else {
                ctx.fillStyle = '#e2e8f0';
                ctx.fillRect(0, 0, W, imgH);
            }

            const grad2 = ctx.createLinearGradient(0, imgH * 0.3, 0, imgH);
            grad2.addColorStop(0, 'rgba(0,0,0,0)');
            grad2.addColorStop(1, 'rgba(0,0,0,0.6)');
            ctx.fillStyle = grad2;
            ctx.fillRect(0, 0, W, imgH);

            ctx.font = 'bold 13px sans-serif';
            ctx.fillStyle = 'rgba(0,0,0,0.3)';
            roundRect(ctx, catX, catY - 14, catW, 22, 4);
            ctx.fill();
            ctx.fillStyle = '#6ee7b7';
            ctx.fillText(cat, catX + 8, catY + 2);

            ctx.font = 'bold 24px sans-serif';
            ctx.fillStyle = '#fff';
            wrapText(ctx, card.querySelector('.nd-share-card-title').textContent.trim(), 24, imgH - 28, W - 48, 30);

            ctx.fillStyle = '#fafbfc';
            ctx.fillRect(0, footerY, W, 50);
            ctx.fillStyle = '#f1f5f9';
            ctx.fillRect(0, footerY, W, 1);
            ctx.font = '13px sans-serif';
            ctx.fillStyle = '#64748b';
            ctx.fillText(meta, 24, footerY + 30);
            ctx.font = 'bold 12px sans-serif';
            ctx.fillStyle = '#cbd5e1';
            ctx.fillText(brand, W - ctx.measureText(brand).width - 24, footerY + 30);
            ctx.fillStyle = primaryColor;
            ctx.fillRect(0, footerY + 50, W, 4);

            ctx.restore();

            const link = document.createElement('a');
            link.download = 'article-share.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
            showToast('Share card downloaded!');
        };

        function roundRect(ctx, x, y, w, h, r) {
            ctx.beginPath();
            ctx.moveTo(x + r, y);
            ctx.lineTo(x + w - r, y);
            ctx.quadraticCurveTo(x + w, y, x + w, y + r);
            ctx.lineTo(x + w, y + h - r);
            ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
            ctx.lineTo(x + r, y + h);
            ctx.quadraticCurveTo(x, y + h, x, y + h - r);
            ctx.lineTo(x, y + r);
            ctx.quadraticCurveTo(x, y, x + r, y);
            ctx.closePath();
        }

        function wrapText(ctx, text, x, y, maxW, lineH) {
            const words = text.split(' ');
            let line = '';
            let lines = [];
            words.forEach(w => {
                const test = line + w + ' ';
                if (ctx.measureText(test).width > maxW && line) {
                    lines.push(line.trim());
                    line = w + ' ';
                } else line = test;
            });
            if (line) lines.push(line.trim());
            // Draw from bottom up so last line is at y
            for (let i = lines.length - 1; i >= 0; i--) {
                ctx.fillText(lines[i], x, y - (lines.length - 1 - i) * lineH);
            }
        }

        const imgEl = card.querySelector('.nd-share-card-img');
        if (imgEl) {
            const image = new Image();
            image.crossOrigin = 'anonymous';
            image.onload = () => drawCard(image);
            image.onerror = () => drawCard(null);
            image.src = imgEl.src;
        } else {
            drawCard(null);
        }
    };

    // ── Reactions ──
    const getUrl  = @json(route('reactions.show', $article->id));
    const postUrl = @json(route('reactions.store', $article->id));

    function updateReactionsUI(data) {
        document.querySelectorAll('.nd-reaction-btn').forEach(btn => {
            const type = btn.dataset.type;
            const countEl = btn.querySelector('.nd-rcount');
            const count = (data.counts && data.counts[type]) || 0;

            if (count > 0) {
                countEl.textContent = count;
                countEl.classList.add('has-count');
            } else {
                countEl.textContent = '';
                countEl.classList.remove('has-count');
            }

            btn.classList.toggle('active', data.user_reaction === type);
        });

        const totalEl = document.getElementById('reaction-total');
        totalEl.textContent = data.total > 0
            ? data.total + ' reaction' + (data.total !== 1 ? 's' : '')
            : 'Be the first to react!';
    }

    fetch(getUrl, { credentials: 'same-origin' })
        .then(r => r.json()).then(updateReactionsUI).catch(() => {});

    document.querySelectorAll('.nd-reaction-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            fetch(postUrl, {
                method: 'POST', credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: JSON.stringify({ type: this.dataset.type }),
            }).then(r => r.json()).then(updateReactionsUI).catch(() => {});
        });
    });

    // ── Comments ──
    const commentsGetUrl  = @json(route('comments.index', $article->id));
    const commentsPostUrl = @json(route('comments.store', $article->id));
    let commentsNextPage = null;

    function renderComment(c, isReply) {
        const sz = isReply ? 30 : 38;
        let h = `<div class="nd-c-item" data-id="${c.id}">`;
        h += `<div class="nd-c-avatar" style="width:${sz}px;height:${sz}px;"><i class="fa-solid fa-user"></i></div>`;
        h += `<div class="nd-c-body">`;
        h += `<div class="nd-c-meta"><span class="nd-c-author">${c.author_name}</span>`;
        if (c.is_own) h += `<span class="nd-c-you">You</span>`;
        h += `<span class="nd-c-time">${c.created_at}${c.date ? ' &middot; ' + c.date : ''}</span></div>`;
        h += `<p class="nd-c-text">${c.body}</p>`;
        if (!isReply) h += `<div class="nd-c-actions"><button class="nd-c-reply-btn" onclick="showReplyForm(${c.id})"><i class="fa-solid fa-reply" style="margin-right:2px;"></i>Reply</button></div>`;
        h += `</div></div>`;

        if (c.replies && c.replies.length) {
            h += `<div class="nd-c-replies">`;
            c.replies.forEach(r => { h += renderComment(r, true); });
            h += `</div>`;
        }
        if (!isReply) {
            h += `<div id="reply-form-${c.id}" style="display:none" class="nd-inline-reply">`;
            h += `<textarea rows="1" placeholder="Write a reply..." id="reply-body-${c.id}" maxlength="2000"></textarea>`;
            h += `<button onclick="submitReply(${c.id})"><i class="fa-solid fa-paper-plane" style="font-size:.7rem;margin-right:2px;"></i>Reply</button>`;
            h += `</div>`;
        }
        return h;
    }

    function loadComments(url) {
        fetch(url || commentsGetUrl, { credentials: 'same-origin' })
            .then(r => r.json()).then(data => {
                document.getElementById('comments-loading').style.display = 'none';
                const list = document.getElementById('comments-list');
                const items = data.data || [];
                document.getElementById('comment-count-badge').textContent = data.total || 0;
                if (!items.length && !url) { document.getElementById('comments-empty').style.display = 'block'; return; }
                document.getElementById('comments-empty').style.display = 'none';
                items.forEach(c => list.insertAdjacentHTML('beforeend', renderComment(c, false)));
                commentsNextPage = data.next_page_url;
                document.getElementById('comments-load-more').style.display = commentsNextPage ? 'block' : 'none';
            }).catch(() => {
                document.getElementById('comments-loading').innerHTML = '<span style="color:#ef4444;">Failed to load comments.</span>';
            });
    }

    window.loadMoreComments = () => { if (commentsNextPage) loadComments(commentsNextPage); };

    window.submitComment = function(e) {
        e.preventDefault();
        const btn = document.getElementById('comment-submit-btn');
        const alertEl = document.getElementById('comment-form-alert');
        const body = document.getElementById('comment-body').value.trim();
        if (!body) return;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Posting...';

        fetch(commentsPostUrl, {
            method: 'POST', credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body: JSON.stringify({
                body, author_name: document.getElementById('comment-name').value.trim() || null,
                author_email: document.getElementById('comment-email').value.trim() || null,
            }),
        }).then(r => r.json()).then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane" style="font-size:.78rem;"></i> Post Comment';
            if (data.success) {
                document.getElementById('comment-body').value = '';
                document.getElementById('comments-empty').style.display = 'none';
                document.getElementById('comments-list').insertAdjacentHTML('afterbegin', renderComment(data.comment, false));
                const b = document.getElementById('comment-count-badge');
                b.textContent = parseInt(b.textContent||0) + 1;
                alertEl.style.display = 'block'; alertEl.style.background = '#ecfdf5'; alertEl.style.color = '#047857';
                alertEl.innerHTML = '<i class="fa-solid fa-check-circle"></i> Comment posted!';
                setTimeout(() => alertEl.style.display = 'none', 3000);
            }
        }).catch(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane" style="font-size:.78rem;"></i> Post Comment';
            alertEl.style.display = 'block'; alertEl.style.background = '#fef2f2'; alertEl.style.color = '#dc2626';
            alertEl.innerHTML = '<i class="fa-solid fa-exclamation-circle"></i> Failed to post. Try again.';
            setTimeout(() => alertEl.style.display = 'none', 4000);
        });
    };

    window.showReplyForm = function(id) {
        document.querySelectorAll('.nd-inline-reply').forEach(f => f.style.display = 'none');
        const f = document.getElementById('reply-form-' + id);
        if (f) { f.style.display = 'flex'; f.querySelector('textarea').focus(); }
    };

    window.submitReply = function(parentId) {
        const ta = document.getElementById('reply-body-' + parentId);
        const body = ta.value.trim();
        if (!body) return;
        fetch(commentsPostUrl, {
            method: 'POST', credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body: JSON.stringify({
                body, parent_id: parentId,
                author_name: document.getElementById('comment-name').value.trim() || null,
                author_email: document.getElementById('comment-email').value.trim() || null,
            }),
        }).then(r => r.json()).then(data => {
            if (data.success) {
                ta.value = '';
                document.getElementById('reply-form-' + parentId).style.display = 'none';
                const el = document.querySelector(`.nd-c-item[data-id="${parentId}"]`);
                let rd = el.nextElementSibling;
                if (!rd || !rd.classList.contains('nd-c-replies')) { rd = document.createElement('div'); rd.className = 'nd-c-replies'; el.after(rd); }
                rd.insertAdjacentHTML('beforeend', renderComment(data.comment, true));
                const b = document.getElementById('comment-count-badge');
                b.textContent = parseInt(b.textContent||0) + 1;
            }
        }).catch(() => {});
    };

    loadComments();
});
</script>
@endsection
