<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\SchoolMiddleware;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\SuperAdminAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',

        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/school.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
            Route::middleware('web')->group(base_path('routes/staff.php'));
        }

    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'super_admin' => SuperAdminAuthMiddleware::class,
            'admin' => AdminAuthMiddleware::class,
            'school' => SchoolMiddleware::class,
            'staff' => StaffMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (Throwable $e, $request) {

            return response()->view('errors.error', [

                'message' => app()->environment('local')
                    ? $e->getMessage()
                    : 'Something went wrong',

                'file' => app()->environment('local')
                    ? $e->getFile()
                    : 'Hidden',

                'line' => app()->environment('local')
                    ? $e->getLine()
                    : 'Hidden',

            ], 500);

        });

    })->create();
