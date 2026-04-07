@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Courses')
@section('header', 'Course Database')

@section('content')
<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-book" style="color: var(--color-primary); opacity: 0.8;"></i> 
            All Courses
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-list-ul" style="font-size: 0.8rem;"></i>
            Manage the syllabus and course catalogues.
        </p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
        <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add New Course
    </a>
</div>

<div data-aos="fade-up" class="filter-card" style="background: white; padding: 1.25rem; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 2rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
    <form action="{{ route('admin.courses.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 250px;">
            <label class="form-label" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem; display: block; text-transform: uppercase; letter-spacing: 0.05em;">Filter by Programme</label>
            <select name="programme_id" class="form-control" style="width: 100%; padding: 0.6rem 1rem; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; color: #334155; font-size: 0.95rem; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);">
                <option value="">All Programmes</option>
                @foreach($programmes as $prog)
                    <option value="{{ $prog->id }}" {{ request('programme_id') == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="width: 180px;">
            <label class="form-label" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem; display: block; text-transform: uppercase; letter-spacing: 0.05em;">Level</label>
            <select name="level" class="form-control" style="width: 100%; padding: 0.6rem 1rem; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; color: #334155; font-size: 0.95rem; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);">
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
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <button type="submit" style="padding: 0.6rem 1.25rem; border-radius: 6px; background: #334155; color: white; border: none; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: background 0.2s;"><i class="fa-solid fa-filter" style="font-size: 0.8em;"></i> Filter</button>
            @if(request('programme_id') || request('level'))
                <a href="{{ route('admin.courses.index') }}" style="padding: 0.6rem 1.25rem; border-radius: 6px; background: #f1f5f9; color: #64748b; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; border: 1px solid #e2e8f0; transition: all 0.2s;"><i class="fa-solid fa-xmark" style="font-size: 0.8em;"></i> Clear</a>
            @endif
        </div>
    </form>
</div>

<style>
    .modern-create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        opacity: 0.95;
    }
    .action-icon-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
        color: #64748b;
        background: white;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    }
    .action-icon-btn:hover {
        transform: scale(1.05);
    }
    .btn-edit:hover { background: #eff6ff; color: #3b82f6; border-color: #bfdbfe; }
    .btn-delete:hover { background: #fef2f2; color: #ef4444; border-color: #fecaca; }
    
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
    }
    .modern-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .modern-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }
    .modern-table tr:hover td {
        background: #f8fafc;
    }
    .modern-table tr:last-child td {
        border-bottom: none;
    }
    .badge-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.2rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-core { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .badge-elective { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
</style>

<div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); overflow-x: auto;">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Course Details</th>
                <th>Programme</th>
                <th>Level/Sem</th>
                <th>Lecturer(s)</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td style="width: 1%;">
                    <div style="display: flex; flex-direction: column; gap: 0.3rem; align-items: flex-start;">
                        <span style="font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.95rem; font-weight: 700; color: var(--color-primary); background: #f1f5f9; padding: 0.3rem 0.6rem; border-radius: 6px; border: 1px solid #e2e8f0; white-space: nowrap;">
                            {{ $course->code }}
                        </span>
                        @if($course->is_elective)
                            <span class="badge-pill badge-elective">Elective</span>
                        @else
                            <span class="badge-pill badge-core">Core</span>
                        @endif
                    </div>
                </td>
                <td>
                    <h3 style="margin: 0 0 0.25rem 0; font-size: 1rem; color: #0f172a; font-weight: 600; line-height: 1.3;">
                        {{ Str::limit($course->title, 60) }}
                    </h3>
                    <div style="color: #64748b; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-cube" style="font-size: 0.8em;"></i> {{ $course->credit_units }} Unit(s)
                    </div>
                </td>
                <td>
                    <div style="color: #475569; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-graduation-cap" style="color: #94a3b8; font-size: 0.85rem;"></i>
                        {{ Str::limit($course->programme->name, 35) }}
                    </div>
                </td>
                <td style="white-space: nowrap;">
                    <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                        <span style="font-size: 0.9rem; color: #334155; font-weight: 500;">
                            Level {{ $course->level }}
                        </span>
                        <span style="font-size: 0.8rem; color: #64748b;">
                            Semester {{ $course->semester }}
                        </span>
                    </div>
                </td>
                <td>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.3rem; max-width: 250px;">
                        @if($course->staff->count())
                            @foreach($course->staff as $lecturer)
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; background: #f0fdf4; color: #166534; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; border: 1px solid #bbf7d0; white-space: nowrap;">
                                    <i class="fa-solid fa-user-tie" style="font-size: 0.7em;"></i> {{ $lecturer->name }}
                                </span>
                            @endforeach
                        @else
                            <span style="color: #94a3b8; font-size: 0.8rem; font-style: italic;">Not assigned</span>
                        @endif
                    </div>
                </td>
                <td style="text-align: center; width: 1%;">
                    <div style="display: flex; justify-content: center; gap: 0.5rem;">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="action-icon-btn btn-edit" title="Edit Course">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" data-confirm="Delete this course?" style="margin: 0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-icon-btn btn-delete" title="Delete Course">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 4rem 2rem;">
                    <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                        <i class="fa-solid fa-book" style="font-size: 2.5rem; color: #94a3b8;"></i>
                    </div>
                    <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No Courses Found</h3>
                    <p style="margin: 0; color: #64748b; font-size: 0.95rem;">No courses found matching criteria.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($courses->hasPages())
    <div style="margin-top: 1.5rem; background: white; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
        {{ $courses->links() }}
    </div>
@endif

@endsection
