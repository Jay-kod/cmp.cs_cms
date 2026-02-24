@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Blog / Research Page Content')
@section('header', 'Blog & Research Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $defaultAreas = '[{"icon":"fa-solid fa-brain","title":"Artificial Intelligence","description":"","color":"#8b5cf6"},{"icon":"fa-solid fa-shield-halved","title":"Cybersecurity","description":"","color":"#ef4444"},{"icon":"fa-solid fa-database","title":"Data Science","description":"","color":"#3b82f6"}]';
    $areas = json_decode($s('blog_research_areas', $defaultAreas), true) ?? [];
@endphp

<style>
.pc-card{background:white;border-radius:12px;border:1px solid #e2e8f0;margin-bottom:1.5rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.pc-card-header{padding:1rem 1.5rem;background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;cursor:pointer;user-select:none}
.pc-card-header h3{margin:0;font-size:1rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.6rem}
.pc-card-body{padding:1.5rem}
.pc-card-body.collapsed{display:none}
.form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:1rem;margin-bottom:1rem}
.form-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:.8rem}
.form-group label{font-size:.85rem;font-weight:600;color:#475569}
.form-group input,.form-group textarea{width:100%;padding:.6rem .9rem;border:1px solid #cbd5e1;border-radius:8px;font-family:inherit;font-size:.95rem;color:#334155;box-sizing:border-box}
.form-group textarea{resize:vertical;min-height:70px}
.toggle-icon{font-size:.8rem;color:#64748b;transition:transform .2s}
.pc-card-header.open .toggle-icon{transform:rotate(180deg)}
.area-row{border:1px solid #e2e8f0;border-radius:10px;padding:1rem;margin-bottom:.8rem;background:#fafafa;position:relative}
.remove-btn{position:absolute;top:.6rem;right:.6rem;background:#fee2e2;color:#ef4444;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer}
</style>

<div style="background:#1e293b;padding:.8rem 1.5rem;border-radius:12px;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between">
    <span style="color:#94a3b8;font-size:.9rem"><i class="fa-solid fa-flask" style="margin-right:6px"></i>Editing: <strong style="color:white">Blog / Research Page</strong></span>
    <a href="{{ route('research-news') }}" target="_blank" style="background:var(--color-primary);color:white;padding:.4rem 1rem;border-radius:8px;font-size:.85rem;font-weight:600;text-decoration:none"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'blog') }}" enctype="multipart/form-data">@csrf

<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-image" style="color:var(--color-primary)"></i> Hero Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group"><label>Badge Text</label><input type="text" name="blog_hero_badge" value="{{ $s('blog_hero_badge','Innovation & Insights') }}"></div>
            <div class="form-group"><label>Hero Title</label><input type="text" name="blog_hero_title" value="{{ $s('blog_hero_title','Research, News & Events') }}"></div>
        </div>
        <div class="form-group"><label>Hero Subtitle</label><textarea name="blog_hero_subtitle" rows="2">{{ $s('blog_hero_subtitle','Stay updated with our latest technological breakthroughs and upcoming academic events.') }}</textarea></div>
        <div class="form-group">
            <label>Hero Background Image</label>
            @if($s('hero_blog'))<div style="margin-bottom:.5rem"><img src="{{ asset('storage/'.$s('hero_blog')) }}" style="height:80px;border-radius:8px;object-fit:cover"></div>@endif
            <input type="file" name="hero_blog" accept="image/jpeg,image/png,image/webp">
        </div>
    </div>
</div>

<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-flask" style="color:var(--color-primary)"></i> Core Research Areas</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div id="areasRepeater">
            @foreach($areas as $i => $area)
            <div class="area-row">
                <button type="button" class="remove-btn" onclick="this.closest('.area-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                <div class="form-row">
                    <div class="form-group"><label>Icon (FA class)</label><input type="text" name="blog_research_areas[{{ $i }}][icon]" value="{{ $area['icon']??'' }}" placeholder="fa-solid fa-brain"></div>
                    <div class="form-group"><label>Title</label><input type="text" name="blog_research_areas[{{ $i }}][title]" value="{{ $area['title']??'' }}"></div>
                    <div class="form-group"><label>Color</label><input type="color" name="blog_research_areas[{{ $i }}][color]" value="{{ $area['color']??'#8b5cf6' }}" style="height:38px;padding:.2rem"></div>
                </div>
                <div class="form-group"><label>Description</label><textarea name="blog_research_areas[{{ $i }}][description]" rows="2">{{ $area['description']??'' }}</textarea></div>
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addArea()" style="background:#f0fdf4;border:1px dashed var(--color-primary);color:var(--color-primary);padding:.6rem 1.2rem;border-radius:8px;font-weight:600;cursor:pointer;width:100%;margin-top:.5rem"><i class="fa-solid fa-plus"></i> Add Research Area</button>
    </div>
</div>

<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-heading" style="color:var(--color-primary)"></i> Section Headers</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div class="form-row">
            <div class="form-group"><label>Publications Title</label><input type="text" name="blog_publications_title" value="{{ $s('blog_publications_title','Recent Publications') }}"></div>
            <div class="form-group"><label>News Title</label><input type="text" name="blog_news_title" value="{{ $s('blog_news_title','Department News') }}"></div>
            <div class="form-group"><label>Events Title</label><input type="text" name="blog_events_title" value="{{ $s('blog_events_title','Upcoming Events') }}"></div>
        </div>
    </div>
</div>

<div style="display:flex;justify-content:flex-end;gap:1rem;padding:1rem 0">
    <a href="{{ route('research-news') }}" target="_blank" class="btn btn-secondary">Preview</a>
    <button type="submit" class="btn" style="background:var(--color-primary);color:white;padding:.75rem 2rem;border:none;border-radius:10px;font-weight:700;font-size:1rem;cursor:pointer"><i class="fa-solid fa-save"></i> Save</button>
</div>
</form>

<script>
function toggleSection(h){h.classList.toggle('open');h.nextElementSibling.classList.toggle('collapsed')}
let ai={{ count($areas) }};
function addArea(){document.getElementById('areasRepeater').insertAdjacentHTML('beforeend',`<div class="area-row"><button type="button" class="remove-btn" onclick="this.closest('.area-row').remove()"><i class="fa-solid fa-xmark"></i></button><div class="form-row"><div class="form-group"><label>Icon</label><input type="text" name="blog_research_areas[${ai}][icon]" placeholder="fa-solid fa-brain"></div><div class="form-group"><label>Title</label><input type="text" name="blog_research_areas[${ai}][title]"></div><div class="form-group"><label>Color</label><input type="color" name="blog_research_areas[${ai}][color]" value="#8b5cf6" style="height:38px;padding:.2rem"></div></div><div class="form-group"><label>Description</label><textarea name="blog_research_areas[${ai}][description]" rows="2"></textarea></div></div>`);ai++;}
</script>
@endsection
