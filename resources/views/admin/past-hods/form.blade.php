@extends($adminLayout ?? 'layouts.admin')
@section('title', $hod->exists ? 'Edit Past HOD' : 'Add Past HOD')
@section('header', $hod->exists ? 'Edit Past Head of Department' : 'Add New Past HOD')

@section('content')
<div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem; max-width: 1000px; margin: 0 auto;">
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

    <form action="{{ $hod->exists ? route('admin.past-hods.update', $hod) : route('admin.past-hods.store') }}" method="POST" enctype="multipart/form-data">     
        @csrf
        @if($hod->exists) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
            
            <!-- Left Column: Personal Detials -->
            <div>
                <h3 style="margin-top: 0; font-size: 1.05rem; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 0.6rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-user-circle" style="color: var(--color-primary, #2563eb);"></i> Personal Information
                </h3>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Full Name <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $hod->name) }}" class="form-control" required placeholder="e.g. Dr. John Doe" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $hod->email) }}" class="form-control" placeholder="e.g. john.doe@university.edu" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $hod->phone) }}" class="form-control" placeholder="e.g. +234 800 000 0000" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Profile Photo</label>
                    @if($hod->photo)
                        <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 15px; background: #f9fafb; padding: 10px; border-radius: 6px; border: 1px solid #e5e7eb;">
                            <img src="{{ asset('storage/'.$hod->photo) }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
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
            </div>

            <!-- Right Column: Academic Details -->
            <div>
                <h3 style="margin-top: 0; font-size: 1.05rem; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 0.6rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-graduation-cap" style="color: var(--color-primary, #2563eb);"></i> Academic & Role Info
                </h3>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Rank</label>
                    <select name="rank" class="form-control" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; background-color: #fff;">
                        <option value="">Select Rank...</option>
                        <option value="Professor" {{ old('rank', $hod->rank) == 'Professor' ? 'selected' : '' }}>Professor</option>
                        <option value="Associate Professor" {{ old('rank', $hod->rank) == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                        <option value="Senior Lecturer" {{ old('rank', $hod->rank) == 'Senior Lecturer' ? 'selected' : '' }}>Senior Lecturer</option>
                        <option value="Lecturer I" {{ old('rank', $hod->rank) == 'Lecturer I' ? 'selected' : '' }}>Lecturer I</option>
                        <option value="Lecturer II" {{ old('rank', $hod->rank) == 'Lecturer II' ? 'selected' : '' }}>Lecturer II</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Qualifications</label>
                    <input type="text" name="qualifications" value="{{ old('qualifications', $hod->qualifications) }}" class="form-control" placeholder="e.g. B.Sc, M.Sc, Ph.D" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151;">Status</label>
                    <select name="status" class="form-control" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; background-color: #fff;">
                        <option value="Active" {{ old('status', $hod->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Retired" {{ old('status', $hod->status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                        <option value="Visiting" {{ old('status', $hod->status) == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                        <option value="Full-Time" {{ old('status', $hod->status) == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="Tenure" {{ old('status', $hod->status) == 'Tenure' ? 'selected' : '' }}>Tenure</option>
                    </select>
                </div>

                <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 6px; padding: 1rem; margin-top: 1.5rem;">
                    <h4 style="margin: 0 0 0.8rem 0; font-size: 0.95rem; color: #0369a1; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-regular fa-calendar-alt"></i> Tenure Period
                    </h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-weight: 500; font-size: 0.85rem; color: #0c4a6e;">Start Year</label>
                            <input type="text" name="tenure_start" value="{{ old('tenure_start', $hod->tenure_start) }}" class="form-control" placeholder="e.g. 2018" style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 4px;">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-weight: 500; font-size: 0.85rem; color: #0c4a6e;">End Year</label>
                            <input type="text" name="tenure_end" value="{{ old('tenure_end', $hod->tenure_end) }}" class="form-control" placeholder="e.g. 2022 or Present" style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 4px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Width: Biography -->
        <div style="margin-top: 2rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-weight: 500; font-size: 0.9rem; color: #374151; display: block; margin-bottom: 0.6rem;">Biography / Summary of Achievements</label>
                <textarea name="bio" class="form-control" rows="5" placeholder="Brief outline of their achievements in office..." style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.95rem;">{{ old('bio', $hod->bio) }}</textarea>
            </div>
        </div>

        <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 2px solid #f3f4f6; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.past-hods.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.5rem; text-decoration: none; border-radius: 6px; font-weight: 500; transition: all 0.2s;">Cancel</a>        
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary, #10b981); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;">
                <i class="fa-solid fa-save" style="margin-right: 5px;"></i> {{ $hod->exists ? 'Update Past HOD' : 'Save Past HOD' }}
            </button>
        </div>
    </form>
</div>
@endsection
