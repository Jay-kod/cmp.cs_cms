@extends('layouts.admin')
@section('title', $publication->exists ? 'Edit Publication' : 'Add Publication')
@section('header', $publication->exists ? 'Edit Publication' : 'New Publication')

@section('content')
<div class="admin-card" style="max-width: 800px;">
    <form method="POST" action="{{ $publication->exists ? route('admin.publications.update', $publication) : route('admin.publications.store') }}">
        @csrf
        @if($publication->exists) @method('PUT') @endif

        <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.2rem;">
            
            <div>
                <label class="admin-label" for="staff_id">Author (Staff Member) <span style="color: red;">*</span></label>
                <select name="staff_id" id="staff_id" class="admin-input" required>
                    <option value="">— Select staff member —</option>
                    @foreach($staff as $s)
                        <option value="{{ $s->id }}" {{ old('staff_id', $publication->staff_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->rank }})</option>
                    @endforeach
                </select>
                @error('staff_id') <div class="admin-error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="admin-label" for="title">Title <span style="color: red;">*</span></label>
                <textarea name="title" id="title" rows="2" class="admin-input" required placeholder="Full title of the publication...">{{ old('title', $publication->title) }}</textarea>
                @error('title') <div class="admin-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label class="admin-label" for="type">Type</label>
                    <select name="type" id="type" class="admin-input">
                        <option value="">— Select type —</option>
                        <option value="journal" {{ old('type', $publication->type) == 'journal' ? 'selected' : '' }}>Journal Article</option>
                        <option value="conference" {{ old('type', $publication->type) == 'conference' ? 'selected' : '' }}>Conference Paper</option>
                        <option value="book" {{ old('type', $publication->type) == 'book' ? 'selected' : '' }}>Book</option>
                        <option value="chapter" {{ old('type', $publication->type) == 'chapter' ? 'selected' : '' }}>Book Chapter</option>
                    </select>
                    @error('type') <div class="admin-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="admin-label" for="year">Year</label>
                    <input type="text" name="year" id="year" class="admin-input" value="{{ old('year', $publication->year) }}" placeholder="e.g. 2025">
                    @error('year') <div class="admin-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div>
                <label class="admin-label" for="journal">Journal / Venue Name</label>
                <input type="text" name="journal" id="journal" class="admin-input" value="{{ old('journal', $publication->journal) }}" placeholder="e.g. IEEE Transactions on...">
                @error('journal') <div class="admin-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label class="admin-label" for="doi">DOI</label>
                    <input type="text" name="doi" id="doi" class="admin-input" value="{{ old('doi', $publication->doi) }}" placeholder="e.g. 10.1109/...">
                    @error('doi') <div class="admin-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="admin-label" for="url">URL / Link</label>
                    <input type="url" name="url" id="url" class="admin-input" value="{{ old('url', $publication->url) }}" placeholder="https://...">
                    @error('url') <div class="admin-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div>
                <label class="admin-label" for="abstract">Abstract</label>
                <textarea name="abstract" id="abstract" rows="4" class="admin-input" placeholder="Brief abstract of the publication...">{{ old('abstract', $publication->abstract) }}</textarea>
                @error('abstract') <div class="admin-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 0.8rem; justify-content: flex-end; border-top: 1px solid #e5e7eb; padding-top: 1.2rem;">
                <a href="{{ route('admin.publications.index') }}" style="padding: 0.6rem 1.2rem; background: #f3f4f6; color: #374151; border-radius: 4px; text-decoration: none; font-size: 0.9rem;">Cancel</a>
                <button type="submit" style="padding: 0.6rem 1.5rem; background: var(--color-primary); color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 0.9rem; font-weight: 600;">
                    <i class="fa-solid fa-save"></i> {{ $publication->exists ? 'Update Publication' : 'Save Publication' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
