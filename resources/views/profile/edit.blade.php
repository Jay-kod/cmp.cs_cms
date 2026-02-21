@extends('layouts.admin')
@section('title', 'My Profile')
@section('header', 'Profile Settings')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card" style="margin-bottom: 1.5rem;">
        <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;">Profile Information</h3>
        <p style="color: #6b7280; font-size: 0.85rem; margin-bottom: 1.5rem;">Update your account's display name and email address.</p>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">Save Profile</button>
                @if (session('status') === 'profile-updated')
                    <span style="color: #10B981; font-size: 0.85rem; margin-left: 1rem;">✓ Saved.</span>
                @endif
            </div>
        </form>
    </div>

    <div class="admin-card" style="margin-bottom: 1.5rem;">
        <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;">Update Password</h3>
        <p style="color: #6b7280; font-size: 0.85rem; margin-bottom: 1.5rem;">Ensure your account uses a long, random password to stay secure.</p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label class="form-label" for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                @error('current_password', 'updatePassword') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">New Password</label>
                <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                @error('password', 'updatePassword') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">Update Password</button>
                @if (session('status') === 'password-updated')
                    <span style="color: #10B981; font-size: 0.85rem; margin-left: 1rem;">✓ Updated.</span>
                @endif
            </div>
        </form>
    </div>

    <div class="admin-card" style="border: 1px solid #fca5a5;">
        <h3 style="margin-top: 0; font-size: 1.05rem; color: #b91c1c; border-bottom: 1px solid #fee2e2; padding-bottom: 0.8rem; margin-bottom: 1.5rem;">Delete Account</h3>
        <p style="color: #6b7280; font-size: 0.85rem; margin-bottom: 1.5rem;">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="form-group">
                <label class="form-label" for="delete_password">Confirm Password</label>
                <input id="delete_password" name="password" type="password" class="form-control" placeholder="Enter your current password to confirm deletion">
                @error('password', 'userDeletion') <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn" style="background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;" onclick="return confirm('Are you absolutely sure you want to delete your account? This action is irreversible.');">Delete Account</button>
            </div>
        </form>
    </div>
</div>
@endsection
