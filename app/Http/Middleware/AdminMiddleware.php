<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * This middleware ensures that the user is authenticated
     * and has the 'admin' role before accessing protected routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // User must be logged in AND must have the 'admin' role
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            // Block access with HTTP 403 Forbidden
            abort(403, 'Only admin can access this route.');

        }

        // Allow request to proceed further
        return $next($request);
    }
}