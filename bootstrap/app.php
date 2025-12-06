<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * This file configures and creates the Laravel application instance.
 * It defines routing, middleware, and exception handling setup.
 */
return Application::configure(basePath: dirname(__DIR__))

    /**
     * Register route files for the application.
     * - web.php      → regular web routes
     * - console.php  → Artisan console commands
     * - /up          → health check endpoint
     */
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    /**
     * Register global and custom middleware.
     * This callback allows extending or modifying the middleware pipeline.
     */
    ->withMiddleware(function (Middleware $middleware): void {
        // Add or modify middleware here if needed
    })

    /**
     * Register the application's exception handling rules.
     */
    ->withExceptions(function (Exceptions $exceptions): void {
        // Customize exception handling here
    })

    /**
     * Finally, create and return the Application instance.
     */
    ->create();
