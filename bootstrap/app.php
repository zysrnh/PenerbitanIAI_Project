<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Global web security headers on every response
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeadersMiddleware::class,
        ]);

        // Role-based route middleware aliases
        $middleware->alias([
            'member' => \App\Http\Middleware\MemberMiddleware::class,
            'admin'  => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // CSRF token validation exceptions (webhook only)
        $middleware->validateCsrfTokens(except: [
            'api/pakasir/webhook',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Return JSON for API requests, prevent stack trace leaks in production
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
