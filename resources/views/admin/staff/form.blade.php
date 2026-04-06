@extends($adminLayout ?? 'layouts.admin')
@section('title', $staff->exists ? 'Edit Staff' : 'Add Staff')
@section('header', $staff->exists ? 'Edit Staff Profile' : 'Add New Staff')

@section('content')
<div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem; max-width: 1100px; margin: 0 auto;">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 6px; margin-bottom: 2rem; border-left: 4px solid #ef4444;">
            <p style="margin: 0 0 0.5rem 0; font-weight: bold;">Please fix the following errors:</p>
            <ul style="margin: 0; padding-left: 1.5rem; font-size: 0.95rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $staff->exists ? route('admin.staff.update', $staff) : route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">     
        @csrf
        @if($staff->exists) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
            
            <!-- Left Column: Personal Identity -->
            <div>
                <h3 style="margin-top: 0; font-size: 1.05rem; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 0.6rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-id-card" style="color: var(--color-primary, #2563eb);"></i> Personal Identity
                </h3>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Full Name <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}" class="form-control" required placeholder="e.g. Dr. Jane Smith" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Email Address <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}" class="form-control" required placeholder="e.g. j.smith@university.edu" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $staff->phone) }}" class="form-control" placeholder="e.g. +234 800 000 0000" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Profile Photo</label>
                    @if($staff->photo)
                        <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 15px; background: #f9fafb; padding: 10px; border-radius: 6px; border: 1px solid #e5e7eb;">
                            <img src="{{ asset('storage/'.$staff->photo) }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                            <div>
                                <span style="font-size: 0.85rem; color: #4b5563; display: block; font-weight: 500;">Current photo uploaded</span>
                                <label style="font-size: 0.8rem; color: #ef4444; display: flex; align-items: center; gap: 5px; cursor: pointer; margin-top: 4px;">
                                    <input type="checkbox" name="remove_photo" value="1" style="accent-color: #ef4444;"> Remove photo
                                </label>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*" style="width: 100%; padding: 0.5rem; border: 1px dashed #d1d5db; border-radius: 6px; background: #f9fafb;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 1.2rem; margin-top: 1rem;">
                        <h4 style="margin: 0 0 0.8rem 0; font-size: 0.95rem; color: #374151;">Role Flags</h4>
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; margin: 0;">
                            <input type="checkbox" name="is_hod" value="1" {{ old('is_hod', $staff->is_hod) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--color-primary, #2563eb); margin-top: 2px;">
                            <div>
                                <span style="font-weight: 600; color: #111827; font-size: 0.95rem;">Head of Department</span>
                                <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #6b7280; line-height: 1.4;">Checking this will remove HOD status from the current holder.</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column: Academic & Role Info -->
            <div>
                <h3 style="margin-top: 0; font-size: 1.05rem; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 0.6rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-graduation-cap" style="color: var(--color-primary, #2563eb);"></i> Academic Profile
                </h3>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Rank <span style="color: #ef4444;">*</span></label>
                    <select name="rank" class="form-control" required style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; background-color: #fff;">
                        <option value="">Select Rank...</option>
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

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Qualifications</label>
                    <input type="text" name="qualifications" value="{{ old('qualifications', $staff->qualifications) }}" class="form-control" placeholder="e.g. Ph.D Information Technology" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Area of Specialization</label>
                    <input type="text" name="specialisation" value="{{ old('specialisation', $staff->specialisation) }}" class="form-control" placeholder="e.g. Information System Mixed Method Research" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Position / Responsibility</label> 
                    <select name="role" class="form-control" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; background-color: #fff;">
                        <option value="">— None —</option>
                        @foreach(\App\Models\StaffRole::orderBy('sort_order')->orderBy('name')->get() as $role)
                            <option value="{{ $role->name }}" {{ old('role', $staff->role) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>       
                        @endforeach
                    </select>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Administrative role within the department (optional). <a href="{{ route('admin.staff-roles.index') }}" style="color: var(--color-primary, #2563eb); font-weight: 500;">Manage roles</a></p>
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Status</label>
                    <select name="status" class="form-control" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; background-color: #fff;">
                        <option value="Tenure" {{ old('status', $staff->status ?? 'Tenure') == 'Tenure' ? 'selected' : '' }}>Tenure</option>
                        <option value="Visiting" {{ old('status', $staff->status) == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                        <option value="Sabbatical" {{ old('status', $staff->status) == 'Sabbatical' ? 'selected' : '' }}>Sabbatical</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Courses Taught</label>
                    <div style="border: 1px solid #d1d5db; border-radius: 6px; max-height: 200px; overflow-y: auto; padding: 0.6rem; background: #fff;">
                        @php $staffCourseIds = old('courses', $staff->exists ? $staff->courses->pluck('id')->toArray() : []); @endphp
                        @forelse($courses as $course)
                        <label style="display: flex; align-items: flex-start; gap: 10px; padding: 0.5rem; cursor: pointer; border-radius: 4px; font-size: 0.9rem; transition: background 0.15s; margin-bottom: 2px;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" {{ in_array($course->id, $staffCourseIds) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: var(--color-primary, #2563eb); margin-top: 3px;">
                            <div>
                                <span style="font-weight: 600; color: #1e40af; display: inline-block; min-width: 65px;">{{ $course->code }}</span>
                                <span style="color: #4b5563; line-height: 1.3;">{{ $course->title }}</span>
                            </div>
                        </label>
                        @empty
                        <p style="color: #94a3b8; font-size: 0.85rem; margin: 0.5rem 0; text-align: center;">No courses available. <a href="{{ route('admin.courses.index') }}" style="color: var(--color-primary, #2563eb); font-weight: 500;">Add courses</a></p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Width: Bio Section -->
        <div style="margin-top: 2rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151; display: block; margin-bottom: 0.6rem;">Biography / Professional Profile</label>
                <textarea name="bio" class="form-control" rows="5" placeholder="Brief biography or professional summary (optional)." style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.95rem;">{{ old('bio', $staff->bio) }}</textarea>
            </div>
        </div>

        <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 2px solid #f3f4f6; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.5rem; text-decoration: none; border-radius: 6px; font-weight: 500; transition: all 0.2s;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary, #10b981); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;">
                <i class="fa-solid fa-save" style="margin-right: 5px;"></i> {{ $staff->exists ? 'Update Staff Member' : 'Save Staff Member' }}
            </button>
        </div>
    </form>
</div>
@endsection
