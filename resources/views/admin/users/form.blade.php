@extends('layouts.admin')
@section('title', isset($user) ? 'Edit Administrator' : 'Add Administrator')
@section('header', isset($user) ? 'Edit Administrator' : 'Add Administrator')

@section('content')
<div class="card" style="max-width: 600px;">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem;">
        {{ isset($user) ? 'Edit Existing Account' : 'Create New Account' }}
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
            <label for="password">{{ isset($user) ? 'New Password (leave blank to keep current)' : 'Password' }} @if(!isset($user))<span style="color: red;">*</span>@endif</label>
            <input type="password" name="password" id="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
            @error('password') <span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password @if(!isset($user))<span style="color: red;">*</span>@endif</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 10px;">
            <button type="submit" class="btn"><i class="fa-solid fa-save"></i> {{ isset($user) ? 'Update Administrator' : 'Create Administrator' }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
