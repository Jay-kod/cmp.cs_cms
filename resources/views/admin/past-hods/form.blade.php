@extends('layouts.admin')
@section('title', $hod->exists ? 'Edit HOD' : 'Add Past HOD')
@section('header', $hod->exists ? 'Edit Past Head of Department' : 'Add New Past HOD')

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

    <form action="{{ $hod->exists ? route('admin.past-hods.update', $hod) : route('admin.past-hods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($hod->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Personal Details</h3>
                
                <div class="form-group">
                    <label class="form-label">Full Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $hod->name) }}" class="form-control" required placeholder="e.g. Dr. John Doe">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    @if($hod->photo)
                        <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('storage/'.$hod->photo) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 50%; border: 1px solid #e5e7eb;">
                            <span style="font-size: 0.8rem; color: #6b7280;">Current photo</span>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Biography / Summary of Tenure</label>
                    <textarea name="bio" class="form-control" rows="4" placeholder="Brief outline of their achievements in office...">{{ old('bio', $hod->bio) }}</textarea>
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Tenure Period</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Tenure Start</label>
                        <input type="text" name="tenure_start" value="{{ old('tenure_start', $hod->tenure_start) }}" class="form-control" placeholder="e.g. 2018">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Tenure End</label>
                        <input type="text" name="tenure_end" value="{{ old('tenure_end', $hod->tenure_end) }}" class="form-control" placeholder="e.g. 2022 or Present">
                    </div>
                </div>
            </div>
            
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.past-hods.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $hod->exists ? 'Update HOD' : 'Save HOD' }}</button>
        </div>
    </form>
</div>
@endsection
