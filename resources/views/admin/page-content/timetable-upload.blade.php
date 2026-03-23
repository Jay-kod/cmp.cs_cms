@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Departmental Timetable')
@section('header', 'Manage Departmental Timetable')

@section('content')
<div class="admin-card" style="max-width: 600px; margin: 0 auto;">
    <h2 style="font-size: 1.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1.5rem;">Upload Departmental Timetable</h2>
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #f87171; font-size: 0.9rem;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.timetable.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label">Timetable File (PDF, XLSX, CSV)</label>
            <input type="file" name="timetable" class="form-control" accept=".pdf,.xlsx,.csv" required>
            <small style="color: #64748b;">Accepted formats: PDF, Excel, or CSV. Max size: 5MB.</small>
        </div>
        <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">Upload Timetable</button>
    </form>
    @if($currentTimetable)
    <div style="margin-top: 2rem;">
        <h4 style="font-size: 1rem; color: #334155; margin-bottom: 0.5rem;">Current Timetable:</h4>
        <a href="{{ asset('storage/timetable/' . $currentTimetable) }}" target="_blank" style="color: var(--color-primary); text-decoration: underline; font-size: 0.95rem;">View/Download Timetable</a>
    </div>
    @endif
</div>
@endsection
