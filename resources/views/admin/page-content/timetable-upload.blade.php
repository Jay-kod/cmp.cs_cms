@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Timetable')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">Departmental Timetable</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Upload the official lecture and exam schedule for the department.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        <a href="{{ route('admin.resources.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'">
            <i class="fa-solid fa-arrow-left"></i> Back to Resources
        </a>
    </div>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #047857; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
        <i class="fa-solid fa-check-circle" style="font-size: 1.1rem;"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background: #fef2f2; color: #b91c1c; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #fecaca; font-size: 0.9rem; display: flex; align-items: stretch; gap: 0.6rem;">
        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.1rem; margin-top: 0.1rem;"></i>
        <ul style="margin: 0; padding-left: 1rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; @if($currentTimetable) grid-template-columns: 2fr 1.2fr; align-items: start; @endif">
    <div class="admin-card" style="padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); background: white;">
        <div style="margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.1rem; color: #0f172a; font-weight: 700; margin: 0 0 0.4rem;">Upload New File</h3>
            <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Uploading a new timetable will overwrite the actively displayed schedule.</p>
        </div>

        <form action="{{ route('admin.timetable.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display:block; font-weight:600; color:#334155; font-size:0.9rem; margin-bottom:0.6rem;">Select Timetable File</label>
                <div style="position: relative; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 2rem; text-align: center; background: #f8fafc; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2.5rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                    <p style="margin: 0 0 0.5rem; color: #475569; font-weight: 600;">Choose a file or drag & drop it here</p>
                    <p style="margin: 0; color: #94a3b8; font-size: 0.8rem;">PDF, Excel, CSV, JPG, PNG, WEBP (Max 5MB)</p>
                    <input type="file" name="timetable" accept=".pdf,.xlsx,.csv,image/*" required style="position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;">
                </div>
            </div>
            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.6rem; width: 100%; background: var(--color-primary); color: white; border: none; padding: 0.8rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);" onmouseover="this.style.filter='brightness(1.1)'; this.style.transform='translateY(-1px)'" onmouseout="this.style.filter='none'; this.style.transform='none'">
                <i class="fa-solid fa-upload"></i> Upload securely
            </button>
        </form>
    </div>

    @if($currentTimetable)
    <div class="admin-card" style="padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); background: white; border-top: 4px solid var(--color-primary);">
        <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: #f0fdf4; color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <h3 style="font-size: 1rem; color: #0f172a; font-weight: 700; margin: 0 0 0.2rem;">Active Timetable</h3>
                <div style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">
                    <div style="width: 5px; height: 5px; background: #10b981; border-radius: 50%;"></div> Live
                </div>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <p style="margin: 0 0 0.5rem; color: #64748b; font-size: 0.85rem; font-weight: 600;">File Name:</p>
            <p style="margin: 0; color: #334155; font-size: 0.9rem; word-break: break-all; background: #f8fafc; padding: 0.6rem 0.8rem; border-radius: 6px; border: 1px solid #e2e8f0; font-family: monospace;">{{ $currentTimetable }}</p>
        </div>

        <a href="{{ asset('storage/timetable/' . $currentTimetable) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 0.7rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#dbeafe'">
            View / Download <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem;"></i>
        </a>
    </div>
    @endif
</div>
@endsection
