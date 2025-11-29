<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // User must be logged in and have role "admin"
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Only admin can access this section.');
        }

        return $next($request);
    }
}