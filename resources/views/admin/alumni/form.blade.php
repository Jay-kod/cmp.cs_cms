@extends('layouts.admin')
@section('title', $alumnus->exists ? 'Edit Alumni' : 'Add Alumni')
@section('header', $alumnus->exists ? 'Edit Graduate Profile' : 'Add New Graduate to Network')

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

    <form action="{{ $alumnus->exists ? route('admin.alumni.update', $alumnus) : route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($alumnus->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Personal Details</h3>
                
                <div class="form-group">
                    <label class="form-label">Full Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $alumnus->name) }}" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    @if($alumnus->photo)
                        <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('storage/'.$alumnus->photo) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 50%; border: 1px solid #e5e7eb;">
                            <span style="font-size: 0.8rem; color: #6b7280;">Current photo</span>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Short Biography / Quote</label>
                    <textarea name="bio" class="form-control" rows="4" placeholder="Brief blurb about their journey... Optional.">{{ old('bio', $alumnus->bio) }}</textarea>
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Academic & Career</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Grad Year <span style="color: red;">*</span></label>
                        <input type="number" name="graduation_year" value="{{ old('graduation_year', $alumnus->graduation_year) }}" class="form-control" required min="1990" max="{{ date('Y') + 1 }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Programme Finished <span style="color: red;">*</span></label>
                        <input type="text" name="programme" value="{{ old('programme', $alumnus->programme) }}" class="form-control" required placeholder="e.g. B.Sc. Computer Science">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Current Employer / Company</label>
                    <input type="text" name="employer" value="{{ old('employer', $alumnus->employer) }}" class="form-control" placeholder="Where do they work now?">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Current Role / Job Title</label>
                    <input type="text" name="current_role" value="{{ old('current_role', $alumnus->current_role) }}" class="form-control" placeholder="e.g. Senior Software Engineer">
                </div>
                
                <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px; margin-top: 1.5rem; font-size: 0.85rem; color: #166534;">
                    <i class="fa-solid fa-lightbulb"></i> <strong>Tip:</strong> Featured alumni highlights appear on the Contact & Alumni page and home page sliders to attract future students.
                </div>
            </div>
            
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $alumnus->exists ? 'Update Alumni Profile' : 'Save Alumni Profile' }}</button>
        </div>
    </form>
</div>
@endsection
