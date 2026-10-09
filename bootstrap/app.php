<?php

declare(strict_types=1);

use App\Exceptions\DomainException;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\EnsureUserHasPermission;
use App\Http\Middleware\PreventArchivedPortfolioMutation;
use App\Http\Middleware\RecordRequestContext;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'active' => EnsureUserIsActive::class,
            'permission' => EnsureUserHasPermission::class,
            'portfolio.mutable' => PreventArchivedPortfolioMutation::class,
        ]);
        $middleware->web(append: [SetLocale::class, RecordRequestContext::class]);
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo('/dashboard');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (DomainException $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $exception->getMessage(),
                    'code' => $exception->errorCode,
                ], 422);
            }

            return null;
        });
        $exceptions->render(function (HttpExceptionInterface $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $exception->getMessage()], $exception->getStatusCode());
            }

            return null;
        });
    })
    ->create();
