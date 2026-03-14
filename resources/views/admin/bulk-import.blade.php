@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Bulk Import — ' . $label)
@section('header', 'Import ' . $label)

@section('content')
{{-- Back link --}}
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.' . $type . '.index') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--color-primary); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
        <i class="fa-solid fa-arrow-left"></i> Back to {{ $label }}
    </a>
</div>

{{-- Errors --}}
@if($errors->any())
<div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 0.5rem; color: #dc2626; font-weight: 700; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-circle-exclamation"></i> Import Errors
    </div>
    <ul style="margin: 0; padding: 0 0 0 1.2rem; color: #b91c1c; font-size: 0.85rem; list-style-type: disc;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('import_errors') && count(session('import_errors')))
<div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d97706; font-weight: 700; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-triangle-exclamation"></i> Some Rows Had Issues
    </div>
    <ul style="margin: 0; padding: 0 0 0 1.2rem; color: #92400e; font-size: 0.85rem; list-style-type: disc; max-height: 200px; overflow-y: auto;">
        @foreach(session('import_errors') as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
</div>
@endif

<div class="admin-card" style="max-width: 720px;">
    <h2 style="margin: 0 0 0.3rem; font-size: 1.15rem; color: #0f172a;">
        <i class="fa-solid fa-file-arrow-up" style="color: var(--color-primary); margin-right: 5px;"></i> Upload File
    </h2>
    <p style="color: #64748b; font-size: 0.85rem; margin: 0 0 1.5rem;">
        Upload an <strong>Excel (.xlsx, .xls)</strong> or <strong>CSV</strong> file with the columns listed below. The first row <strong>must</strong> be the header row.
    </p>

    {{-- Expected columns --}}
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;">
        <div style="font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 0.5rem;">Expected Columns:</div>
        <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
            @foreach($columns as $col)
                @php
                    $displayName = $col;
                    if ($type === 'staff' && $col === 'name') {
                        $displayName = 'name, email, address & phone';
                    }
                @endphp
                <span style="display: inline-flex; align-items: center; gap: 0.25rem; background: {{ in_array($col, $required) ? '#dcfce7' : '#f1f5f9' }}; color: {{ in_array($col, $required) ? '#166534' : '#475569' }}; padding: 3px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; font-family: monospace;">
                    {{ $displayName }}
                    @if(in_array($col, $required))
                        <span style="color: #dc2626; font-weight: 800;">*</span>
                    @endif
                </span>
            @endforeach
        </div>
        <p style="margin: 0.6rem 0 0; font-size: 0.78rem; color: #94a3b8;">
            <span style="color: #dc2626; font-weight: 800;">*</span> = required.
            Extra columns will be ignored. Column order doesn't matter as long as the header names match.
        </p>
        @if($type === 'staff')
        <p style="margin: 0.5rem 0 0; font-size: 0.78rem; color: #64748b; background: #eff6ff; padding: 6px 10px; border-radius: 6px; border: 1px solid #bfdbfe;">
            <i class="fa-solid fa-info-circle" style="color: #3b82f6;"></i>
            <strong>Tip:</strong> The first column should contain the <strong>Name, Email, Address, and Phone Number</strong>
            — each on a separate row for the same person. The system will automatically merge them.
            The <strong>S/N</strong> column will be ignored automatically.
            Status accepts: <strong>Tenure</strong>, <strong>Visiting</strong>, or <strong>Sabbatical</strong>.
        </p>
        @endif
    </div>

    {{-- Download template --}}
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.bulk-import.template', $type) }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--color-primary); text-decoration: none; font-weight: 600; font-size: 0.85rem; border: 1px dashed var(--color-primary); padding: 0.5rem 1rem; border-radius: 6px;">
            <i class="fa-solid fa-download"></i> Download CSV Template
        </a>
    </div>

    {{-- Upload form --}}
    <form action="{{ route('admin.bulk-import.preview', $type) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 1.5rem;">
            <label for="csv_file" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem;">
                Select File
            </label>
            <div id="dropZone" style="border: 2px dashed #d1d5db; border-radius: 10px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; background: #fafafa;"
                 ondragover="event.preventDefault(); this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4';"
                 ondragleave="this.style.borderColor='#d1d5db'; this.style.background='#fafafa';"
                 ondrop="event.preventDefault(); this.style.borderColor='#d1d5db'; this.style.background='#fafafa'; document.getElementById('csv_file').files = event.dataTransfer.files; showFileName();"
                 onclick="document.getElementById('csv_file').click();">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2rem; color: #94a3b8; margin-bottom: 0.5rem; display: block;"></i>
                <p id="dropText" style="margin: 0; color: #6b7280; font-size: 0.9rem;">
                    Drag & drop your file here, or <span style="color: var(--color-primary); font-weight: 600; text-decoration: underline;">browse</span>
                </p>
                <p style="margin: 0.3rem 0 0; color: #94a3b8; font-size: 0.75rem;">Supports: .xlsx, .xls, .csv &nbsp;|&nbsp; Max size: 5 MB</p>
            </div>
            <input type="file" name="csv_file" id="csv_file" accept=".csv,.txt,.xlsx,.xls" style="display: none;" onchange="showFileName();" required>
        </div>

        <button type="submit" id="importBtn" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.7rem 1.8rem; border-radius: 8px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;" disabled>
            <i class="fa-solid fa-eye"></i> Upload & Preview
        </button>
    </form>
</div>

<script>
    function showFileName() {
        const input = document.getElementById('csv_file');
        const text = document.getElementById('dropText');
        const btn = document.getElementById('importBtn');
        if (input.files.length > 0) {
            var icon = input.files[0].name.match(/\.xlsx?$/i) ? 'fa-file-excel' : 'fa-file-csv';
            text.innerHTML = '<i class="fa-solid ' + icon + '" style="color: var(--color-primary); margin-right: 4px;"></i> <strong>' + input.files[0].name + '</strong>';
            btn.disabled = false;
            btn.style.opacity = '1';
        }
    }
</script>
@endsection
