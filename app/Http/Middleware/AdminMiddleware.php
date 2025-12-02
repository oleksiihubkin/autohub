<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Пользователь должен быть залогинен и иметь роль admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            // Можно вернуть 403 или редирект на главную
            abort(403, 'Only admin can access this route.');
            // или:
            // return redirect()->route('dashboard')->with('error','Admin only');
        }

        return $next($request);
    }
}