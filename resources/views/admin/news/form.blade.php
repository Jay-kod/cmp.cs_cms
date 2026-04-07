@extends($adminLayout ?? 'layouts.admin')
@section('title', $news->exists ? 'Edit Article' : 'Write Article')
@section('header', $news->exists ? 'Edit News Article' : 'Write New Article')

@section('content')
<div data-aos="fade-up" class="admin-card">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($news->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            <!-- Left Column: Main Content -->
            <div>
                <div class="form-group">
                    <label class="form-label">Article Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" class="form-control" required style="font-size: 1.2rem; padding: 0.8rem;">
                </div>
                
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Article Content <span style="color: red;">*</span></label>
                    <textarea name="body" class="form-control richtext" rows="15" style="font-family: inherit;">{{ old('body', $news->body) }}</textarea>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Basic HTML is supported.</p>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Author <span style="color: red;">*</span></label>
                    <div style="display: flex; gap: 1rem; margin-bottom: 0.75rem;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 0.6rem 1rem; border: 2px solid #e5e7eb; border-radius: 6px; flex: 1; transition: all 0.2s;" id="author-admin-label">
                            <input type="radio" name="author_type" value="admin" id="author_admin"
                                {{ old('author_type', $news->author_type ?? 'admin') == 'admin' ? 'checked' : '' }}
                                onchange="toggleAuthorName(this)"
                                style="width: 16px; height: 16px;">
                            <div>
                                <strong style="display: block; font-size: 0.88rem;">Admin</strong>
                                <span style="font-size: 0.75rem; color: #6b7280;">Written by the site admin</span>
                            </div>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 0.6rem 1rem; border: 2px solid #e5e7eb; border-radius: 6px; flex: 1; transition: all 0.2s;" id="author-outside-label">
                            <input type="radio" name="author_type" value="outside" id="author_outside"
                                {{ old('author_type', $news->author_type ?? 'admin') == 'outside' ? 'checked' : '' }}
                                onchange="toggleAuthorName(this)"
                                style="width: 16px; height: 16px;">
                            <div>
                                <strong style="display: block; font-size: 0.88rem;">Outside Author</strong>
                                <span style="font-size: 0.75rem; color: #6b7280;">Written by an external contributor</span>
                            </div>
                        </label>
                    </div>
                    <div id="author-name-wrapper" style="display: none; margin-top: 0.5rem;">
                        <input type="text" name="author_name" id="author_name_input"
                            value="{{ old('author_name', $news->author_name ?? '') }}"
                            class="form-control"
                            placeholder="Full name of the author (required)">
                    </div>
                </div>
            </div>


            <!-- Right Column: Meta & Settings -->
            <div>
                <div data-aos="fade-up" class="admin-card" style="box-shadow: none; border: 1px solid #e5e7eb; padding: 1.2rem; background: #f9fafb;">
                    <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Publishing Options</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Category <span style="color: red;">*</span></label>
                        <select name="category" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="Department News" {{ old('category', $news->category) == 'Department News' ? 'selected' : '' }}>Department News</option>
                            <option value="Research Highlight" {{ old('category', $news->category) == 'Research Highlight' ? 'selected' : '' }}>Research Highlight</option>
                            <option value="Student Spotlight" {{ old('category', $news->category) == 'Student Spotlight' ? 'selected' : '' }}>Student Spotlight</option>
                            <option value="Award" {{ old('category', $news->category) == 'Award' ? 'selected' : '' }}>Award / Recognition</option>
                            <option value="General" {{ old('category', $news->category) == 'General' ? 'selected' : '' }}>General Info</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label class="form-label">Sub-Department</label>
                        <select name="department_code" class="form-control">
                            <option value="">— Generic / All —</option>
                            <option value="cs" {{ old('department_code', $news->department_code) == 'cs' ? 'selected' : '' }}>Computer Science</option>
                            <option value="cyb" {{ old('department_code', $news->department_code) == 'cyb' ? 'selected' : '' }}>Cyber Security</option>
                            <option value="ds" {{ old('department_code', $news->department_code) == 'ds' ? 'selected' : '' }}>Data Science</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Publish Date/Time</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('Y-m-d\TH:i') : '') }}" class="form-control">
                        <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">Leave blank to save as Draft. Set future date to schedule.</p>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }} style="width: 18px; height: 18px; margin-top: 2px;">
                            <div>
                                <strong style="display: block; font-size: 0.9rem;">Feature this article</strong>
                                <span style="font-size: 0.75rem; color: #6b7280;">Featured articles appear in the hero slider on the homepage.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div data-aos="fade-up" class="admin-card" style="box-shadow: none; border: 1px solid #e5e7eb; padding: 1.2rem; margin-top: 1.5rem;">
                    <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Featured Image</h3>
                    
                    @if($news->featured_image)
                        <div style="margin-bottom: 1rem;">
                            <img src="{{ asset('storage/'.$news->featured_image) }}" style="width: 100%; height: auto; border-radius: 4px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                    
                    <div class="form-group mb-0">
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                        <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">Recommended size: 1200x630px (Max 2MB)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $news->exists ? 'Update Article' : 'Save Article' }}</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function toggleAuthorName(radio) {
    const wrapper = document.getElementById('author-name-wrapper');
    const nameInput = document.getElementById('author_name_input');
    const adminLabel = document.getElementById('author-admin-label');
    const outsideLabel = document.getElementById('author-outside-label');

    const isOutside = radio.value === 'outside';

    wrapper.style.display = isOutside ? 'block' : 'none';
    nameInput.required = isOutside;

    adminLabel.style.borderColor = !isOutside ? 'var(--color-primary, #2563eb)' : '#e5e7eb';
    adminLabel.style.background = !isOutside ? '#eff6ff' : '';
    outsideLabel.style.borderColor = isOutside ? 'var(--color-primary, #2563eb)' : '#e5e7eb';
    outsideLabel.style.background = isOutside ? '#eff6ff' : '';
}

// Run on page load to reflect existing state
document.addEventListener('DOMContentLoaded', function () {
    const selected = document.querySelector('input[name="author_type"]:checked');
    if (selected) toggleAuthorName(selected);
});
</script>
@endsection
