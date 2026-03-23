<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetAdminLayoutForSuperAdmins
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isSuperAdmin()) {
            // Admin Blade pages already use `$adminLayout ?? 'layouts.admin'`.
            // Sharing this view variable makes super-admin render the same admin
            // pages inside the super-admin layout/theme.
            View::share('adminLayout', 'layouts.super-admin');
        }

        return $next($request);
    }
}

