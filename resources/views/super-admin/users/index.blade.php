@extends('layouts.super-admin')
@section('title', 'User Management')
@section('header', 'User Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 1.25rem;">All System Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn" style="background: #b91c1c; border-color: #b91c1c;"><i class="fa-solid fa-user-plus"></i> Add New User</a>
    </div>

    @if($users->count())
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created On</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: {{ $user->isSuperAdmin() ? '#b91c1c' : '#16a34a' }}; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div style="font-weight: 600;">{{ $user->name }} @if(auth()->id() === $user->id) <span class="badge" style="background: #fef2f2; color: #b91c1c;">You</span> @endif</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
                            background: {{ $user->isSuperAdmin() ? '#fef2f2' : '#f0fdf4' }};
                            color: {{ $user->isSuperAdmin() ? '#b91c1c' : '#16a34a' }};">
                            <i class="fa-solid {{ $user->isSuperAdmin() ? 'fa-shield-halved' : 'fa-user-gear' }}" style="font-size: 0.7rem;"></i>
                            {{ $user->role_label }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            
                            @if(auth()->id() !== $user->id)
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}', 'this user account')">
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
        <h3>No Users Found</h3>
        <p>There are currently no user accounts in the system.</p>
    </div>
    @endif
</div>
@endsection
