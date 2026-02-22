@extends('layouts.admin')
@section('title', $page->exists ? 'Edit Page' : 'Add Page')
@section('header', $page->exists ? 'Edit: ' . $page->title : 'Add New Page')

@section('content')
<div class="admin-card">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST">
        @csrf
        @if($page->exists) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
            <!-- Main Column -->
            <div>
                <div class="form-group">
                    <label class="form-label">Page Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control" required placeholder="e.g. Privacy Policy" {{ $page->is_system ? '' : '' }}>
                </div>

                <div class="form-group">
                    <label class="form-label">Page Content <span style="color: red;">*</span></label>
                    <p style="font-size: 0.8rem; color: #6b7280; margin-bottom: 0.5rem;">HTML is supported. Use &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;a&gt; tags for formatting.</p>
                    <textarea name="content" class="form-control" rows="22" required style="font-family: 'Courier New', monospace; font-size: 0.88rem; line-height: 1.6;">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div style="background: #f9fafb; padding: 1.5rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                    <h4 style="margin-top: 0; margin-bottom: 1rem; font-size: 0.95rem;">Page Settings</h4>

                    @if($page->exists && $page->slug)
                    <div class="form-group">
                        <label class="form-label">URL</label>
                        <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 4px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #6b7280;">
                            /page/<strong style="color: #111827;">{{ $page->slug }}</strong>
                        </div>
                        @if($page->is_system)
                        <small style="color: #9ca3af;">System page — slug cannot be changed.</small>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Icon (Font Awesome class)</label>
                        <input type="text" name="icon" value="{{ old('icon', $page->icon) }}" class="form-control" placeholder="e.g. fa-solid fa-shield-halved">
                        @if($page->icon)
                        <div style="margin-top: 0.5rem;">
                            <span style="font-size: 0.82rem; color: #6b7280;">Preview:</span>
                            <i class="{{ $page->icon }}" style="font-size: 1.2rem; color: var(--color-primary); margin-left: 0.3rem;"></i>
                        </div>
                        @endif
                    </div>

                    <div class="form-group" style="padding: 1rem; background: #fff; border-radius: 4px; border: 1px solid #e5e7eb;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $page->exists ? $page->is_active : true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <strong>Published (visible on website)</strong>
                        </label>
                    </div>

                    @if($page->exists)
                    <div style="font-size: 0.8rem; color: #9ca3af; margin-top: 1rem; padding-top: 0.8rem; border-top: 1px solid #e5e7eb;">
                        <p style="margin: 0;">Created: {{ $page->created_at->format('M j, Y g:ia') }}</p>
                        <p style="margin: 0.2rem 0 0;">Updated: {{ $page->updated_at->format('M j, Y g:ia') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $page->exists ? 'Update Page' : 'Save Page' }}</button>
        </div>
    </form>
</div>
@endsection
