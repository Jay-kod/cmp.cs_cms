@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Programmes')
@section('header', 'Academic Programmes')

@section('content')
<div class="admin-header-modern" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
    <div>
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-graduation-cap" style="color: var(--color-primary); opacity: 0.8;"></i> 
            All Programmes
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-layer-group" style="font-size: 0.8rem;"></i>
            Manage the academic offerings of the department.
        </p>
    </div>
    <a href="{{ route('admin.programmes.create') }}" class="modern-create-btn" style="background: var(--color-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
        <i class="fa-solid fa-plus" style="font-size: 0.9em;"></i> Add New Programme
    </a>
</div>

<style>
    .modern-create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        opacity: 0.95;
    }
    .programme-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f5f9;
        overflow: hidden;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
    }
    .programme-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #e2e8f0;
    }
    .programme-header {
        padding: 1.25rem;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .programme-body {
        padding: 1.25rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .programme-footer {
        padding: 1rem 1.25rem;
        background: #fafaf9;
        border-top: 1px dashed #e2e8f0;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.75rem;
    }
    .programme-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #475569;
        font-size: 0.9rem;
    }
    .programme-meta-item i {
        color: #94a3b8;
        width: 16px;
        text-align: center;
    }
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    .status-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .status-hidden { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

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
</style>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem;">
    @forelse($programmes as $prog)
        <div class="programme-card">
            <div class="programme-header">
                <div style="flex: 1; padding-right: 1rem;">
                    <h3 style="margin: 0 0 0.25rem 0; font-size: 1.1rem; color: #0f172a; font-weight: 700; line-height: 1.3;">
                        {{ $prog->name }}
                    </h3>
                    <div style="font-family: monospace; font-size: 0.75rem; color: #64748b; background: #f1f5f9; padding: 0.15rem 0.4rem; border-radius: 4px; display: inline-block; border: 1px solid #e2e8f0;">
                        {{ $prog->slug }}
                    </div>
                </div>
                <div>
                    @if($prog->is_active)
                        <span class="status-pill status-active">
                            @if(isset($prog->is_active) && $prog->is_active)
                                <span style="width: 6px; height: 6px; background: #22c55e; border-radius: 50%; box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);"></span>
                            @endif
                            Active
                        </span>
                    @else
                        <span class="status-pill status-hidden">
                            <i class="fa-solid fa-eye-slash"></i> Hidden
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="programme-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="display: block; font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; margin-bottom: 0.25rem;">Level</span>
                        <div class="programme-meta-item" style="color: #334155; font-weight: 500;">
                            <i class="fa-solid fa-layer-group"></i> {{ $prog->level }}
                        </div>
                    </div>
                    <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; border: 1px solid #f1f5f9;">
                        <span style="display: block; font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; margin-bottom: 0.25rem;">Duration</span>
                        <div class="programme-meta-item" style="color: #334155; font-weight: 500;">
                            <i class="fa-regular fa-calendar"></i> {{ $prog->duration }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="programme-footer">
                <a href="{{ route('admin.programmes.edit', $prog) }}" class="action-icon-btn btn-edit" title="Edit Programme">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <form action="{{ route('admin.programmes.destroy', $prog) }}" method="POST" data-confirm="Delete this programme? All associated courses may be orphaned." style="margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="action-icon-btn btn-delete" title="Delete Programme">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; padding: 4rem 2rem; text-align: center;">
            <div style="width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 1px solid #f1f5f9;">
                <i class="fa-solid fa-graduation-cap" style="font-size: 2.5rem; color: #94a3b8;"></i>
            </div>
            <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem; font-weight: 600;">No Programmes Found</h3>
            <p style="margin: 0; color: #64748b; font-size: 0.95rem;">You haven't added any academic programmes yet.</p>
        </div>
    @endforelse
</div>

@if($programmes->hasPages())
    <div style="margin-top: 2rem; background: white; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9;">
        {{ $programmes->links() }}
    </div>
@endif

@endsection
