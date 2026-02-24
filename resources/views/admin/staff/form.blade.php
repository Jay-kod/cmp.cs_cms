@extends($adminLayout ?? 'layouts.admin')
@section('title', $staff->exists ? 'Edit Staff' : 'Add Staff')
@section('header', $staff->exists ? 'Edit Staff Profile' : 'Add New Staff')

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

    <form action="{{ $staff->exists ? route('admin.staff.update', $staff) : route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($staff->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $staff->title) }}" class="form-control" placeholder="e.g. Prof., Dr., Mr., Mrs.">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Full Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Qualifications</label>
                    <input type="text" name="qualifications" value="{{ old('qualifications', $staff->qualifications) }}" class="form-control" placeholder="e.g. B.Sc., M.Sc., Ph.D.">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Rank / Position <span style="color: red;">*</span></label>
                    <select name="rank" class="form-control" required>
                        <option value="">Select Rank</option>
                        <option value="Professor" {{ old('rank', $staff->rank) == 'Professor' ? 'selected' : '' }}>Professor</option>
                        <option value="Associate Professor" {{ old('rank', $staff->rank) == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                        <option value="Senior Lecturer" {{ old('rank', $staff->rank) == 'Senior Lecturer' ? 'selected' : '' }}>Senior Lecturer</option>
                        <option value="Lecturer I" {{ old('rank', $staff->rank) == 'Lecturer I' ? 'selected' : '' }}>Lecturer I</option>
                        <option value="Lecturer II" {{ old('rank', $staff->rank) == 'Lecturer II' ? 'selected' : '' }}>Lecturer II</option>
                        <option value="Assistant Lecturer" {{ old('rank', $staff->rank) == 'Assistant Lecturer' ? 'selected' : '' }}>Assistant Lecturer</option>
                        <option value="Technologist" {{ old('rank', $staff->rank) == 'Technologist' ? 'selected' : '' }}>Technologist</option>
                        <option value="Administrative Staff" {{ old('rank', $staff->rank) == 'Administrative Staff' ? 'selected' : '' }}>Administrative Staff</option>
                        <option value="Technical Staff" {{ old('rank', $staff->rank) == 'Technical Staff' ? 'selected' : '' }}>Technical Staff</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Departmental Role</label>
                    <select name="role" class="form-control">
                        <option value="">— None —</option>
                        @foreach(\App\Models\StaffRole::orderBy('sort_order')->orderBy('name')->get() as $role)
                            <option value="{{ $role->name }}" {{ old('role', $staff->role) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Administrative role within the department (optional). <a href="{{ route('admin.staff-roles.index') }}" style="color: var(--color-primary);">Manage roles</a></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Specialisation / Research Area</label>
                    <input type="text" name="specialisation" value="{{ old('specialisation', $staff->specialisation) }}" class="form-control" placeholder="e.g. Artificial Intelligence, Data Science">
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Email Address <span style="color: red;">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $staff->phone) }}" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    @if($staff->photo)
                        <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('storage/'.$staff->photo) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                            <span style="font-size: 0.8rem; color: #6b7280;">Current photo</span>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Max 2MB. Leave blank to keep current photo.</p>
                </div>

                <div class="form-group" style="padding: 1rem; background: #f9fafb; border-radius: 4px; border: 1px solid #e5e7eb; margin-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 0.5rem;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $staff->exists ? $staff->is_active : true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Active Staff Member</strong>
                    </label>
                    <p style="margin: 0 0 0 28px; font-size: 0.8rem; color: #6b7280;">Inactive staff won't appear on the public directory.</p>
                    
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-top: 1rem; margin-bottom: 0.5rem;">
                        <input type="checkbox" name="is_hod" value="1" {{ old('is_hod', $staff->is_hod) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Head of Department</strong>
                    </label>
                    <p style="margin: 0 0 0 28px; font-size: 0.8rem; color: #6b7280;">Checking this will remove HOD status from the current holder.</p>
                </div>
            </div>
            
            <!-- Full Width -->
            <div style="grid-column: 1 / -1;">
                <div class="form-group">
                    <label class="form-label">Biography</label>
                    <textarea name="bio" class="form-control" rows="6" placeholder="Brief biography or professional summary.">{{ old('bio', $staff->bio) }}</textarea>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $staff->exists ? 'Update Staff Member' : 'Save Staff Member' }}</button>
        </div>
    </form>
</div>
@endsection
