<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Illuminate\Http\Request; // Import class Request

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

        // LOGIKA BARU: Redirect user yang sudah login saat mengakses /login
        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->user()->hasRole('admin')) {
                return route('/dashboard'); 
            }
            
            if ($request->user()->hasRole('pegawai')) {
                return url('/pegawai'); 
            }

            if ($request->user()->hasRole('pimpinan')) {
                return url('/pimpinan'); 
            }

            return '/dashboard'; // default jika role lain
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();