<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * Only regular admins use this login — super admins have their own guard.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Block super admins from the regular admin portal
        if ($request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();

            return redirect()->route('super-admin.login.form')
                ->with('status', 'Please use the Super Admin portal to sign in.');
        }

        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    /**
     * Destroy an authenticated session (regular admin logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // After logout, send the user back to the admin login page.
        return redirect()->route('login');
    }
}
