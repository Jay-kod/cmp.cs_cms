<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Deny access unless the user has at least editor-level access.
     * This is the base gate for the entire admin panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isEditor()) {
            abort(403, 'Access denied. Administrator privileges required.');
        }

        return $next($request);
    }
}
