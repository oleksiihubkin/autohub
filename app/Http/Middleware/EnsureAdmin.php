<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * This middleware checks that the user is authenticated
     * and has the "admin" role before allowing access to the route.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Deny access if the user is not logged in or not an admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Only admin can access this section.');
        }

        // Continue to the next middleware or controller
        return $next($request);
    }
}