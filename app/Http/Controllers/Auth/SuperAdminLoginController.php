<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Handle login — only allow super_admin role through.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Check if the authenticated user is actually a super admin
        if (! $request->user()->isSuperAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'This portal is restricted to Super Administrators only.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/admin/super-dashboard');
    }
}
