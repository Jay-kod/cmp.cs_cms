@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Departmental Systems')
@section('header', 'External Systems')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">Departmental Systems</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage external system links shown in the website footer</p>
    </div>
    <a href="{{ route('admin.external-systems.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-plus"></i> Add System</a>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #86efac; font-size: 0.9rem;">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; border: 1px solid #f87171; font-size: 0.9rem;">
    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
</div>
@endif

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th>System Name</th>
                <th>URL</th>
                <th>Status</th>
                <th>Target</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($systems as $system)
            <tr>
                <td style="color: #9ca3af; font-size: 0.82rem;">{{ $system->sort_order }}</td>
                <td>
                    <i class="{{ $system->icon }}" style="color: var(--color-primary); margin-right: 0.4rem;"></i>
                    <strong>{{ $system->name }}</strong>
                    @if($system->description)
                        <br><span style="font-size: 0.78rem; color: #9ca3af;">{{ Str::limit($system->description, 60) }}</span>
                    @endif
                </td>
                <td>
                    <code style="background: #f3f4f6; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.8rem; word-break: break-all;">{{ Str::limit($system->url, 40) }}</code>
                </td>
                <td>
                    @if($system->is_active)
                        <span style="color: #10B981; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Active</span>
                    @else
                        <span style="color: #6b7280; font-weight: bold; font-size: 0.85rem;"><i class="fa-solid fa-circle-minus"></i> Hidden</span>
                    @endif
                </td>
                <td style="font-size: 0.82rem; color: #6b7280;">
                    @if($system->open_in_new_tab)
                        <i class="fa-solid fa-up-right-from-square" style="margin-right: 0.2rem;"></i> New Tab
                    @else
                        <i class="fa-solid fa-arrow-right" style="margin-right: 0.2rem;"></i> Same Tab
                    @endif
                </td>
                <td>
                    <div class="actions">
                        @if($system->url && $system->url !== '#')
                            <a href="{{ $system->url }}" target="_blank" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #f0fdf4; color: #166534; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-eye"></i> Visit</a>
                        @endif
                        <a href="{{ route('admin.external-systems.edit', $system) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px;"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.external-systems.destroy', $system) }}" method="POST" data-confirm="Delete this system link?" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem 1rem;">
                    <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
                        <i class="fa-solid fa-up-right-from-square" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                        <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No External Systems Found</h3>
                        <p style="margin: 0; color: #64748b;">No external systems added yet.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
