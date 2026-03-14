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
            <!-- Column 1: Identity -->
            <div>
                <h3 style="margin: 0 0 1rem; font-size: 0.95rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    <i class="fa-solid fa-user" style="color: var(--color-primary); margin-right: 5px;"></i> Name, Email, Address & Phone
                </h3>

                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $staff->title) }}" class="form-control" placeholder="e.g. Prof., Dr., Mr., Mrs.">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Full Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}" class="form-control" placeholder="e.g. staff@nsuk.edu.ng">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $staff->phone) }}" class="form-control" placeholder="e.g. 080XXXXXXXX">
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address', $staff->address) }}" class="form-control" placeholder="e.g. Department of Computer Science, NSUK">
                </div>

                <div class="form-group">
                    <label class="form-label">Office Address / Location</label>
                    <input type="text" name="office_location" value="{{ old('office_location', $staff->office_location) }}" class="form-control" placeholder="e.g. Room 205, Block B, Faculty of Science">
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
            </div>

            <!-- Column 2: Academic & Role Info -->
            <div>
                <h3 style="margin: 0 0 1rem; font-size: 0.95rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    <i class="fa-solid fa-graduation-cap" style="color: var(--color-primary); margin-right: 5px;"></i> Academic & Role Details
                </h3>

                <div class="form-group">
                    <label class="form-label">Rank <span style="color: red;">*</span></label>
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
                    <label class="form-label">Qualifications</label>
                    <input type="text" name="qualifications" value="{{ old('qualifications', $staff->qualifications) }}" class="form-control" placeholder="e.g. B.Sc., M.Sc., Ph.D.">
                </div>

                <div class="form-group">
                    <label class="form-label">Area of Specialization</label>
                    <input type="text" name="specialisation" value="{{ old('specialisation', $staff->specialisation) }}" class="form-control" placeholder="e.g. Artificial Intelligence, Data Science">
                </div>

                <div class="form-group">
                    <label class="form-label">Position / Responsibility</label>
                    <select name="role" class="form-control">
                        <option value="">— None —</option>
                        @foreach(\App\Models\StaffRole::orderBy('sort_order')->orderBy('name')->get() as $role)
                            <option value="{{ $role->name }}" {{ old('role', $staff->role) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Administrative role within the department (optional). <a href="{{ route('admin.staff-roles.index') }}" style="color: var(--color-primary);">Manage roles</a></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Tenure" {{ old('status', $staff->status ?? 'Tenure') == 'Tenure' ? 'selected' : '' }}>Tenure</option>
                        <option value="Visiting" {{ old('status', $staff->status) == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                        <option value="Sabbatical" {{ old('status', $staff->status) == 'Sabbatical' ? 'selected' : '' }}>Sabbatical</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Courses Taught</label>
                    <div style="border: 1px solid #e5e7eb; border-radius: 6px; max-height: 200px; overflow-y: auto; padding: 0.6rem;">
                        @php $staffCourseIds = old('courses', $staff->exists ? $staff->courses->pluck('id')->toArray() : []); @endphp
                        @forelse($courses as $course)
                        <label style="display: flex; align-items: center; gap: 8px; padding: 0.35rem 0.4rem; cursor: pointer; border-radius: 4px; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='transparent'">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" {{ in_array($course->id, $staffCourseIds) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #059669;">
                            <span style="font-weight: 600; color: #1e3a8a; min-width: 70px;">{{ $course->code }}</span>
                            <span style="color: #475569;">{{ $course->title }}</span>
                        </label>
                        @empty
                        <p style="color: #94a3b8; font-size: 0.85rem; margin: 0.5rem 0; text-align: center;">No courses available. <a href="{{ route('admin.courses.index') }}" style="color: var(--color-primary);">Add courses</a></p>
                        @endforelse
                    </div>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Select the courses this staff member teaches.</p>
                </div>

                <div class="form-group" style="padding: 1rem; background: #f9fafb; border-radius: 4px; border: 1px solid #e5e7eb; margin-top: 1rem;">
                    <label style="font-weight: 700; font-size: 0.9rem; color: #374151; margin-bottom: 0.5rem; display: block;">Flags</label>

                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_hod" value="1" {{ old('is_hod', $staff->is_hod) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Head of Department</strong>
                    </label>
                    <p style="margin: 0 0 0 28px; font-size: 0.8rem; color: #6b7280;">Checking this will remove HOD status from the current holder.</p>
                </div>
            </div>
            
            <!-- Full Width: Bio -->
            <div style="grid-column: 1 / -1;">
                <div class="form-group">
                    <label class="form-label">Biography</label>
                    <textarea name="bio" class="form-control" rows="5" placeholder="Brief biography or professional summary (optional).">{{ old('bio', $staff->bio) }}</textarea>
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
