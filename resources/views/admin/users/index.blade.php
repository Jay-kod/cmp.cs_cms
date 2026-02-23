@extends('layouts.admin')
@section('title', 'Manage Administrators')
@section('header', 'Administrators')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 1.25rem;">Administrator Accounts</h2>
        <a href="{{ route('admin.users.create') }}" class="btn"><i class="fa-solid fa-plus"></i> Add New Admin</a>
    </div>

    @if($users->count())
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: var(--color-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div style="font-weight: 600;">{{ $user->name }} @if(auth()->id() === $user->id) <span class="badge" style="background: var(--color-bg-alt); color: var(--color-primary);">You</span> @endif</div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            
                            @if(auth()->id() !== $user->id)
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}', 'this administrator account')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @else
                            <button type="button" class="btn btn-danger btn-sm" title="Cannot delete yourself" disabled style="opacity: 0.5; cursor: not-allowed;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
    @else
    <div class="empty-state">
        <i class="fa-solid fa-users" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
        <h3>No Administrators Found</h3>
        <p>There are currently no additional administrative accounts.</p>
    </div>
    @endif
</div>
@endsection
