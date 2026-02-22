@extends('layouts.admin')
@section('title', $course->exists ? 'Edit Course' : 'Add Course')
@section('header', $course->exists ? 'Edit Course' : 'Add New Course')

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

    <form action="{{ $course->exists ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST">
        @csrf
        @if($course->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Course Code <span style="color: red;">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $course->code) }}" class="form-control" required placeholder="e.g. CSC101" style="font-family: monospace; text-transform: uppercase;">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Course Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $course->title) }}" class="form-control" required placeholder="e.g. Introduction to Computing">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Parent Programme <span style="color: red;">*</span></label>
                    <select name="programme_id" class="form-control" required>
                        <option value="">Select Programme</option>
                        @foreach($programmes as $prog)
                            <option value="{{ $prog->id }}" {{ old('programme_id', $course->programme_id) == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Lecturer(s)</label>
                    <select name="staff_ids[]" class="form-control" multiple style="min-height: 120px;">
                        @foreach($allStaff as $s)
                            <option value="{{ $s->id }}" {{ (collect(old('staff_ids', $course->exists ? $course->staff->pluck('id')->toArray() : []))->contains($s->id)) ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Hold Ctrl/Cmd to select multiple lecturers.</p>
                </div>
                
            </div>

            <!-- Column 2 -->
            <div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Level <span style="color: red;">*</span></label>
                        <select name="level" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="100" {{ old('level', $course->level) == '100' ? 'selected' : '' }}>100 Level</option>
                            <option value="200" {{ old('level', $course->level) == '200' ? 'selected' : '' }}>200 Level</option>
                            <option value="300" {{ old('level', $course->level) == '300' ? 'selected' : '' }}>300 Level</option>
                            <option value="400" {{ old('level', $course->level) == '400' ? 'selected' : '' }}>400 Level</option>
                            <option value="500" {{ old('level', $course->level) == '500' ? 'selected' : '' }}>500 Level (PG)</option>
                            <option value="800" {{ old('level', $course->level) == '800' ? 'selected' : '' }}>800 Level (PG)</option>
                            <option value="900" {{ old('level', $course->level) == '900' ? 'selected' : '' }}>900 Level (PG)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Semester <span style="color: red;">*</span></label>
                        <select name="semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="1" {{ old('semester', $course->semester) == 1 ? 'selected' : '' }}>1st Semester</option>
                            <option value="2" {{ old('semester', $course->semester) == 2 ? 'selected' : '' }}>2nd Semester</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Credit Units <span style="color: red;">*</span></label>
                    <input type="number" name="credit_units" value="{{ old('credit_units', $course->credit_units) }}" class="form-control" required min="1" max="10">
                </div>
                
                <div class="form-group" style="padding: 1rem; background: #f9fafb; border-radius: 4px; border: 1px solid #e5e7eb; margin-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_elective" value="1" {{ old('is_elective', $course->is_elective) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <strong>Elective Course</strong>
                    </label>
                    <p style="margin: 0 0 0 28px; font-size: 0.8rem; color: #6b7280;">If unchecked, this course is considered a Core (compulsory) course.</p>
                </div>
            </div>
            
            <div style="grid-column: 1 / -1;">
                <div class="form-group">
                    <label class="form-label">Course Description / Synopsis</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Brief overview of course topics.">{{ old('description', $course->description) }}</textarea>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $course->exists ? 'Update Course' : 'Save Course' }}</button>
        </div>
    </form>
</div>
@endsection
