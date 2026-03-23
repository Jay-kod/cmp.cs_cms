<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SuperAdminLoginController extends Controller
{
    /**
     * Show the super-admin login page.
     */
    public function create(): View
    {
        return view('auth.super-admin-login');
    }

    /**
     * Handle login — authenticate via the super_admin guard.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Normalize email to avoid invisible whitespace mismatches.
        $email = trim((string) $request->input('email'));
        $password = (string) $request->input('password');

        if (! Auth::guard('super_admin')->attempt(
            ['email' => $email, 'password' => $password],
            $request->boolean('remember')
        )) {
            $message = trans('auth.failed');

            if (config('app.debug')) {
                $user = User::where('email', $email)->first();
                $emailFound = $user ? 'yes' : 'no';
                $role = $user ? ($user->role ?? 'NULL') : 'n/a';
                $passwordMatch = $user ? (Hash::check($password, $user->password) ? 'yes' : 'no') : 'n/a';

                $message .= " Debug: email_found={$emailFound}, role={$role}, password_match={$passwordMatch}.";
            }

            throw ValidationException::withMessages([
                'email' => $message,
            ]);
        }

        // Verify the authenticated user actually holds the super_admin role
        $user = Auth::guard('super_admin')->user();

        if (! $user->isSuperAdmin()) {
            Auth::guard('super_admin')->logout();

            throw ValidationException::withMessages([
                'email' => 'This portal is restricted to Super Administrators only.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/super-admin');
    }

    /**
     * Destroy the super-admin session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('super_admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('super-admin.login.form');
    }
}
