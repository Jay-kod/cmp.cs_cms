@extends('layouts.admin')
@section('title', 'Manage Courses')
@section('header', 'Course Database')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <h2 style="margin: 0; font-size: 1.1rem;">All Courses</h2>
            <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage the syllabus and course catalogues.</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add New Course</a>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('admin.courses.index') }}" method="GET" style="background: #f9fafb; padding: 1rem; border-radius: 4px; border: 1px solid #e5e7eb; display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px;">
            <label class="form-label" style="font-size: 0.8rem;">Filter by Programme</label>
            <select name="programme_id" class="form-control" style="padding: 0.4rem;">
                <option value="">All Programmes</option>
                @foreach($programmes as $prog)
                    <option value="{{ $prog->id }}" {{ request('programme_id') == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="width: 150px;">
            <label class="form-label" style="font-size: 0.8rem;">Level</label>
            <select name="level" class="form-control" style="padding: 0.4rem;">
                <option value="">All Levels</option>
                <option value="100" {{ request('level') == '100' ? 'selected' : '' }}>100 Level</option>
                <option value="200" {{ request('level') == '200' ? 'selected' : '' }}>200 Level</option>
                <option value="300" {{ request('level') == '300' ? 'selected' : '' }}>300 Level</option>
                <option value="400" {{ request('level') == '400' ? 'selected' : '' }}>400 Level</option>
                <option value="500" {{ request('level') == '500' ? 'selected' : '' }}>500 Level (PG)</option>
                <option value="800" {{ request('level') == '800' ? 'selected' : '' }}>800 Level (PG)</option>
                <option value="900" {{ request('level') == '900' ? 'selected' : '' }}>900 Level (PG)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary" style="padding: 0.4rem 1rem; border-radius: 4px; background: white; border: 1px solid #d1d5db; cursor: pointer;">Filter</button>
        @if(request('programme_id') || request('level'))
            <a href="{{ route('admin.courses.index') }}" style="font-size: 0.85rem; color: #ef4444; text-decoration: none; padding: 0.4rem;">Clear</a>
        @endif
    </form>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Course Title</th>
                <th>Programme</th>
                <th>Lvl / Sem</th>
                <th>Lecturer(s)</th>
                <th>Units / Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td style="font-weight: bold; font-family: monospace; font-size: 1rem; color: var(--color-primary);">{{ $course->code }}</td>
                <td>{{ Str::limit($course->title, 40) }}</td>
                <td>{{ Str::limit($course->programme->name, 25) }}</td>
                <td>Lvl {{ $course->level }}<br><span style="font-size: 0.75rem; color: #6b7280;">Sem {{ $course->semester }}</span></td>
                <td>
                    @if($course->staff->count())
                        @foreach($course->staff as $lecturer)
                            <span style="display: inline-block; background: #f0fdf4; color: #15803d; padding: 2px 8px; border-radius: 4px; font-size: 0.78rem; font-weight: 500; margin: 1px 0;">{{ $lecturer->name }}</span>
                        @endforeach
                    @else
                        <span style="color: #9ca3af; font-size: 0.8rem; font-style: italic;">Not assigned</span>
                    @endif
                </td>
                <td>
                    {{ $course->credit_units }} Unit(s)<br>
                    @if($course->is_elective)
                        <span style="background: #fef3c7; color: #d97706; padding: 2px 6px; border-radius: 4px; font-size: 0.65rem; font-weight: bold; text-transform: uppercase;">Elective</span>
                    @else
                        <span style="background: #e0e7ff; color: #4338ca; padding: 2px 6px; border-radius: 4px; font-size: 0.65rem; font-weight: bold; text-transform: uppercase;">Core</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i></a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" data-confirm="Delete this course?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 2rem;">No courses found matching criteria.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($courses->hasPages())
    <div style="padding: 1rem; border-top: 1px solid #e5e7eb;">
        {{ $courses->links() }}
    </div>
    @endif
</div>
@endsection
