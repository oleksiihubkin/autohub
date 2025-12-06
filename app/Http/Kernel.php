<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     * These middleware run on *every* request to the application.
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware groups.
     * The "web" group applies session, CSRF, cookies, etc.
     * The "api" group is lighter and stateless by design.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // No sessions, no CSRF — API should be stateless
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware aliases (Laravel 11/12 style).
     * These are convenient short names used in routes:
     * Example: Route::middleware(['auth', 'admin'])
     */
    protected $middlewareAliases = [
        'auth'     => \App\Http\Middleware\Authenticate::class,
        'guest'    => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Our custom admin-only middleware
        'admin'    => \App\Http\Middleware\EnsureAdmin::class,
    ];

    /**
     * Legacy / backward-compatible route middleware map.
     * Some packages or internal features still reference this.
     * Safe to keep, but aliases above are preferred in new code.
     */
    protected $routeMiddleware = [
        'auth'     => \App\Http\Middleware\Authenticate::class,
        'guest'    => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Duplicate of alias for compatibility
        'admin'    => \App\Http\Middleware\EnsureAdmin::class,
    ];
}