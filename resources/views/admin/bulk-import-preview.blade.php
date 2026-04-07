@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Preview Import — ' . $label)
@section('header', 'Preview: ' . $label . ' Import')

@section('content')
{{-- Back link --}}
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.bulk-import.show', $type) }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--color-primary); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
        <i class="fa-solid fa-arrow-left"></i> Back to Upload
    </a>
</div>

{{-- Summary card --}}
<div data-aos="fade-up" class="admin-card" style="margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-file-lines" style="font-size: 1.2rem; color: var(--color-primary);"></i>
            <div>
                <div style="font-size: 0.78rem; color: #94a3b8; text-transform: uppercase; font-weight: 600;">Records Found</div>
                <div style="font-size: 1.3rem; font-weight: 800; color: #0f172a;">{{ count($records) }}</div>
            </div>
        </div>
        @if($skipped > 0)
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-forward" style="font-size: 1.2rem; color: #f59e0b;"></i>
            <div>
                <div style="font-size: 0.78rem; color: #94a3b8; text-transform: uppercase; font-weight: 600;">Auto-Skipped</div>
                <div style="font-size: 1.3rem; font-weight: 800; color: #d97706;">{{ $skipped }}</div>
            </div>
        </div>
        @endif
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-table-columns" style="font-size: 1.2rem; color: #6366f1;"></i>
            <div>
                <div style="font-size: 0.78rem; color: #94a3b8; text-transform: uppercase; font-weight: 600;">Columns Mapped</div>
                <div style="font-size: 1.3rem; font-weight: 800; color: #4338ca;">{{ count($mappingInfo) }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Column mapping info --}}
<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 0.8rem 1.2rem; margin-bottom: 1rem;">
    <div style="font-weight: 700; font-size: 0.82rem; color: #166534; margin-bottom: 0.4rem;">
        <i class="fa-solid fa-arrows-left-right"></i> Column Mapping
    </div>
    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
        @foreach($mappingInfo as $info)
        <span style="background: #dcfce7; color: #166534; padding: 3px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; font-family: monospace;">
            {{ $info }}
        </span>
        @endforeach
    </div>
</div>

{{-- Skipped row warnings --}}
@if(count($errors) > 0)
<div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 0.8rem 1.2rem; margin-bottom: 1rem;">
    <div style="font-weight: 700; font-size: 0.82rem; color: #d97706; margin-bottom: 0.4rem;">
        <i class="fa-solid fa-triangle-exclamation"></i> Rows Automatically Skipped
    </div>
    <ul style="margin: 0; padding: 0 0 0 1.2rem; color: #92400e; font-size: 0.8rem; list-style-type: disc; max-height: 150px; overflow-y: auto;">
        @foreach($errors as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(count($records) === 0)
    <div data-aos="fade-up" class="admin-card" style="text-align: center; padding: 3rem;">
        <i class="fa-solid fa-file-circle-xmark" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
        <h3 style="margin: 0 0 0.5rem; color: #334155;">No Valid Records Found</h3>
        <p style="color: #64748b;">The file was parsed but no valid records were detected. Check your column headers and data format.</p>
        <a href="{{ route('admin.bulk-import.show', $type) }}" class="btn" style="margin-top: 1rem; display: inline-flex; align-items: center; gap: 0.4rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 6px; text-decoration: none; font-weight: 600;">
            <i class="fa-solid fa-arrow-left"></i> Try Again
        </a>
    </div>
@else
    {{-- Instructions --}}
    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 0.7rem 1rem; margin-bottom: 1rem;">
        <p style="margin: 0; font-size: 0.82rem; color: #1e40af;">
            <i class="fa-solid fa-info-circle" style="color: #3b82f6;"></i>
            <strong>Review the data below.</strong> Uncheck any rows you want to <strong>exclude</strong> from the import, then click <strong>"Confirm Import"</strong> to save.
        </p>
    </div>

    <form action="{{ route('admin.bulk-import.confirm', $type) }}" method="POST" id="confirmForm">
        @csrf

        {{-- Preview table --}}
        <div class="admin-table-container" style="margin-bottom: 1.5rem;">
            <table class="admin-table" style="font-size: 0.82rem;">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" id="selectAll" checked title="Select/Deselect All" style="cursor: pointer;">
                        </th>
                        <th style="width: 40px;">#</th>
                        @foreach($displayColumns as $col)
                            <th>{{ ucwords(str_replace('_', ' ', $col)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $i => $record)
                    <tr id="row-{{ $i }}" style="transition: opacity 0.2s;">
                        <td>
                            <input type="checkbox" class="row-check" data-row="{{ $i }}" checked style="cursor: pointer;">
                        </td>
                        <td style="color: #94a3b8; font-weight: 600;">{{ $i + 1 }}</td>
                        @foreach($displayColumns as $col)
                            <td>
                                @php $val = $record[$col] ?? ''; @endphp
                                @if($col === 'status')
                                    @if($val === 'Tenure')
                                        <span style="color: #10B981; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-circle-check"></i> Tenure</span>
                                    @elseif($val === 'Visiting')
                                        <span style="color: #3b82f6; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-plane-arrival"></i> Visiting</span>
                                    @elseif($val === 'Sabbatical')
                                        <span style="color: #f59e0b; font-weight: bold; font-size: 0.8rem;"><i class="fa-solid fa-clock"></i> Sabbatical</span>
                                    @else
                                        <span style="color: #6b7280;">{{ $val ?: '—' }}</span>
                                    @endif
                                @elseif($col === 'name')
                                    <strong>{{ $val ?: '—' }}</strong>
                                @else
                                    {{ $val ?: '—' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Hidden inputs for excluded rows (filled by JS) --}}
        <div id="excludeInputs"></div>

        {{-- Action buttons --}}
        <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <button type="submit" id="confirmBtn" class="btn btn-primary" style="background: #059669; color: white; padding: 0.7rem 1.8rem; border-radius: 8px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-check-double"></i> Confirm Import (<span id="selectedCount">{{ count($records) }}</span> records)
            </button>
            <a href="{{ route('admin.bulk-import.show', $type) }}" style="color: #6b7280; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="fa-solid fa-xmark"></i> Cancel & Re-upload
            </a>
        </div>
    </form>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checks = document.querySelectorAll('.row-check');
    const countSpan = document.getElementById('selectedCount');
    const confirmBtn = document.getElementById('confirmBtn');
    const excludeDiv = document.getElementById('excludeInputs');
    const total = checks.length;

    function updateCount() {
        let checked = 0;
        checks.forEach(cb => { if (cb.checked) checked++; });
        if (countSpan) countSpan.textContent = checked;
        if (confirmBtn) confirmBtn.disabled = checked === 0;

        // Visual: dim unchecked rows
        checks.forEach(cb => {
            const row = document.getElementById('row-' + cb.dataset.row);
            if (row) {
                row.style.opacity = cb.checked ? '1' : '0.35';
                row.style.textDecoration = cb.checked ? 'none' : 'line-through';
            }
        });

        // Update select-all state
        if (selectAll) selectAll.checked = checked === total;
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checks.forEach(cb => { cb.checked = selectAll.checked; });
            updateCount();
        });
    }

    checks.forEach(cb => {
        cb.addEventListener('change', updateCount);
    });

    // Before submit: create hidden inputs for excluded (unchecked) rows
    const form = document.getElementById('confirmForm');
    if (form) {
        form.addEventListener('submit', function() {
            excludeDiv.innerHTML = '';
            checks.forEach(cb => {
                if (!cb.checked) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'exclude[]';
                    input.value = cb.dataset.row;
                    excludeDiv.appendChild(input);
                }
            });
        });
    }
});
</script>
@endsection
