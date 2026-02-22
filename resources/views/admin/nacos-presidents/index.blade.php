@extends('layouts.admin')
@section('title', 'NACOS Presidents')

@section('header')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="margin: 0; font-size: 1.5rem; color: #1e293b;">NACOS Presidents</h1>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.9rem;">Manage former and current NACOS (National Association of Computing Students) Presidents.</p>
    </div>
    <a href="{{ route('admin.nacos-presidents.create') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600;">
        <i class="fa-solid fa-plus"></i> Add President
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    @if(session('success'))
        <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="admin-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                    <th style="padding: 1rem; color: #475569; font-weight: 600;">President</th>
                    <th style="padding: 1rem; color: #475569; font-weight: 600;">Tenure</th>
                    <th style="padding: 1rem; color: #475569; font-weight: 600;">Current Status</th>
                    <th style="padding: 1rem; color: #475569; font-weight: 600; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($presidents as $p)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            @if($p->photo)
                                <img src="{{ asset('storage/'.$p->photo) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                            @else
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.2rem;"><i class="fa-solid fa-user"></i></div>
                            @endif
                            <div>
                                <strong style="color: #0f172a; display: block;">{{ $p->name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 1rem; color: #475569;">
                        {{ $p->tenure_start ?? 'Unknown' }} - {{ $p->tenure_end ?? 'Present' }}
                    </td>
                    <td style="padding: 1rem; color: #475569;">
                        {{ $p->current_status ?: '-' }}
                    </td>
                    <td style="padding: 1rem; text-align: right;">
                        <a href="{{ route('admin.nacos-presidents.edit', $p) }}" style="color: #3b82f6; margin-right: 0.5rem;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.nacos-presidents.destroy', $p) }}" method="POST" style="display: inline;" data-confirm="Are you sure you want to delete this president?">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0;" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 3rem; text-align: center; color: #64748b;">
                        <i class="fa-solid fa-users-slash" style="font-size: 2rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                        <p>No NACOS Presidents added yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
