<?php

declare(strict_types=1);

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(
        function (Middleware $middleware): void {
            /*
            |--------------------------------------------------------------------------
            | ALIAS MIDDLEWARE
            |--------------------------------------------------------------------------
            */

            $middleware->alias([
                'admin.auth' => AdminAuthMiddleware::class,
            ]);
        }
    )
    ->withExceptions(
        function (Exceptions $exceptions): void {
            /*
            |--------------------------------------------------------------------------
            | RESPONS JSON UNTUK API
            |--------------------------------------------------------------------------
            */

            $exceptions->shouldRenderJsonWhen(
                static fn (Request $request): bool =>
                    $request->is('api/*')
            );
        }
    )
    ->create();