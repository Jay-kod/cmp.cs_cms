@extends('layouts.admin')
@section('title', $announcement->exists ? 'Edit Announcement' : 'New Announcement')
@section('header', $announcement->exists ? 'Edit Notice Details' : 'Broadcast New Notice')

@section('content')
<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $announcement->exists ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" method="POST">
        @csrf
        @if($announcement->exists) @method('PUT') @endif
        
        <div class="form-group">
            <label class="form-label">Notice Headline <span style="color: red;">*</span></label>
            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="form-control" required placeholder="e.g. Course Registration Deadline Extended">
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Target Audience <span style="color: red;">*</span></label>
                <select name="audience" class="form-control" required>
                    <option value="">Select Audience...</option>
                    <option value="All Students" {{ old('audience', $announcement->audience) == 'All Students' ? 'selected' : '' }}>All Students</option>
                    <option value="Undergraduate Students" {{ old('audience', $announcement->audience) == 'Undergraduate Students' ? 'selected' : '' }}>Undergraduate Students</option>
                    <option value="Postgraduate Students" {{ old('audience', $announcement->audience) == 'Postgraduate Students' ? 'selected' : '' }}>Postgraduate Students</option>
                    <option value="Prospective Students" {{ old('audience', $announcement->audience) == 'Prospective Students' ? 'selected' : '' }}>Prospective Students (General Public)</option>
                    <option value="Staff & Faculty" {{ old('audience', $announcement->audience) == 'Staff & Faculty' ? 'selected' : '' }}>Staff & Faculty</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Priority Level <span style="color: red;">*</span></label>
                <select name="priority" class="form-control" required>
                    <option value="low" {{ old('priority', $announcement->priority) == 'low' ? 'selected' : '' }}>Low (Sidebar only)</option>
                    <option value="normal" {{ old('priority', $announcement->priority) == 'normal' ? 'selected' : '' }}>Normal (Standard notice)</option>
                    <option value="high" {{ old('priority', $announcement->priority) == 'high' ? 'selected' : '' }}>High (Red banner across top)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Expiration Date / Auto-Remove</label>
            <input type="date" name="expires_at" value="{{ old('expires_at', $announcement->expires_at ? \Carbon\Carbon::parse($announcement->expires_at)->format('Y-m-d') : '') }}" class="form-control">
            <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">Leave blank to keep active permanently until manually deleted.</p>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <label class="form-label">Detailed Message</label>
            <textarea name="body" class="form-control" rows="6" placeholder="Brief details about the announcement. Optional.">{{ old('body', $announcement->body) }}</textarea>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $announcement->exists ? 'Save Changes' : 'Broadcast Announcement' }}</button>
        </div>
    </form>
</div>
@endsection
