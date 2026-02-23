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
     * Super admins are redirected to use their dedicated portal.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Super admins must use the dedicated super-admin login portal
        if ($request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('super-admin.login.form')
                ->with('status', 'Please use the Super Admin portal to sign in.');
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $isSuperAdmin = $request->user()?->isSuperAdmin();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($isSuperAdmin ? '/super-admin/login' : '/login');
    }
}
