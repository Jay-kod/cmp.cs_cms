<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMinRole
{
    /**
     * Check that the user has at least the given role level.
     * Usage: middleware('role:admin') or middleware('role:super_admin')
     */
    public function handle(Request $request, Closure $next, string $minRole): Response
    {
        if (! $request->user() || ! $request->user()->hasMinRole($minRole)) {
            abort(403, 'Access denied. Insufficient privileges.');
        }

        return $next($request);
    }
}
