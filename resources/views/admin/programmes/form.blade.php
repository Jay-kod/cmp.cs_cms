@extends($adminLayout ?? 'layouts.admin')
@section('title', $programme->exists ? 'Edit Programme' : 'Add Programme')
@section('header', $programme->exists ? 'Edit Programme' : 'Add New Programme')

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

    <form action="{{ $programme->exists ? route('admin.programmes.update', $programme) : route('admin.programmes.store') }}" method="POST">
        @csrf
        @if($programme->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Programme Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $programme->name) }}" class="form-control" required placeholder="e.g. B.Sc. Computer Science">
                </div>

                <div class="form-group">
                    <label class="form-label">Programme Category</label>
                    <select name="programme_category_id" class="form-control">
                        <option value="">— No Category —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('programme_category_id', $programme->programme_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Sub-Department</label>
                    <select name="department_code" class="form-control">
                        <option value="">— Generic / All —</option>
                        <option value="cs" {{ old('department_code', $programme->department_code) == 'cs' ? 'selected' : '' }}>Computer Science</option>
                        <option value="cyb" {{ old('department_code', $programme->department_code) == 'cyb' ? 'selected' : '' }}>Cyber Security</option>
                        <option value="ds" {{ old('department_code', $programme->department_code) == 'ds' ? 'selected' : '' }}>Data Science</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Level <span style="color: red;">*</span></label>
                    <select name="level" class="form-control" required>
                        <option value="">Select Level</option>
                        <option value="BSc" {{ old('level', $programme->level) == 'BSc' ? 'selected' : '' }}>BSc (Undergraduate)</option>
                        <option value="PGD" {{ old('level', $programme->level) == 'PGD' ? 'selected' : '' }}>PGD (Postgraduate Diploma)</option>
                        <option value="MSc" {{ old('level', $programme->level) == 'MSc' ? 'selected' : '' }}>MSc (Master's)</option>
                        <option value="PhD" {{ old('level', $programme->level) == 'PhD' ? 'selected' : '' }}>PhD (Doctorate)</option>
                        <option value="Diploma" {{ old('level', $programme->level) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Duration <span style="color: red;">*</span></label>
                    <input type="text" name="duration" value="{{ old('duration', $programme->duration) }}" class="form-control" placeholder="e.g. 4 Years" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mode of Study <span style="color: red;">*</span></label>
                    <input type="text" name="mode_of_study" value="{{ old('mode_of_study', $programme->mode_of_study) }}" class="form-control" placeholder="e.g. Full Time" required>
                </div>
                
                <div class="form-group" style="padding: 1rem; background: #f9fafb; border-radius: 4px; border: 1px solid #e5e7eb;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $programme->exists ? $programme->is_active : true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Show Programme on Website</strong>
                    </label>
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Programme Description <span style="color: red;">*</span></label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $programme->description) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Programme Objectives</label>
                    <textarea name="objectives" class="form-control" rows="3">{{ old('objectives', $programme->objectives) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Career Pathways</label>
                    <textarea name="career_pathways" class="form-control" rows="3">{{ old('career_pathways', $programme->career_pathways) }}</textarea>
                </div>
            </div>
            
            <!-- Full Width Details -->
            <div style="grid-column: 1 / -1; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">UTME Requirements/O-Level</label>
                    <textarea name="requirements_utme" class="form-control" rows="3">{{ old('requirements_utme', $programme->requirements_utme) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Direct Entry Requirements</label>
                    <textarea name="requirements_de" class="form-control" rows="3">{{ old('requirements_de', $programme->requirements_de) }}</textarea>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.programmes.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $programme->exists ? 'Update Programme' : 'Save Programme' }}</button>
        </div>
    </form>
</div>
@endsection
