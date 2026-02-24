@extends('layouts.super-admin')
@section('title', isset($user) ? 'Edit User' : 'Add User')
@section('header', isset($user) ? 'Edit User' : 'Add User')

@section('content')
<div class="card" style="max-width: 600px;">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem;">
        {{ isset($user) ? 'Edit User Account' : 'Create New User Account' }}
    </h2>

    <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="form-group">
            <label for="name">Full Name <span style="color: red;">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
            @error('name') <span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address <span style="color: red;">*</span></label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
            @error('email') <span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="role">Role <span style="color: red;">*</span></label>
            <select name="role" id="role" class="form-control" required>
                <option value="{{ \App\Models\User::ROLE_ADMIN }}" {{ old('role', $user->role ?? '') == \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Admin</option>
                <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" {{ old('role', $user->role ?? '') == \App\Models\User::ROLE_SUPER_ADMIN ? 'selected' : '' }}>Super Admin</option>
            </select>
            <p style="margin: 5px 0 0; font-size: 0.8rem; color: #6b7280;">
                <strong>Admin:</strong> Manages all content (staff, programmes, news, etc.).<br>
                <strong>Super Admin:</strong> Full system control — everything admin can do, plus user management, settings, and backups.
            </p>
            @error('role') <span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ isset($user) ? 'New Password (leave blank to keep current)' : 'Password' }} @if(!isset($user))<span style="color: red;">*</span>@endif</label>
            <input type="password" name="password" id="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
            @error('password') <span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password @if(!isset($user))<span style="color: red;">*</span>@endif</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 10px;">
            <button type="submit" class="btn" style="background: #b91c1c; border-color: #b91c1c;"><i class="fa-solid fa-save"></i> {{ isset($user) ? 'Update User' : 'Create User' }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
