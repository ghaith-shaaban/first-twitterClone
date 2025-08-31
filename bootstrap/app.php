<?php

use App\Http\Middleware\is_admin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
            web: [
        __DIR__.'/../routes/web.php',
        __DIR__.'/../routes/idea.php',
        __DIR__.'/../routes/admin.php',
        __DIR__.'/../routes/auth.php',
        __DIR__.'/../routes/comment.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['is_admin'=>is_admin::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
