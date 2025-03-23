<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\APIResponseMiddleware;
use App\Http\Middleware\JwtMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        apiPrefix: '',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(APIResponseMiddleware::class);
        $middleware->alias(['auth.jwt' => JwtMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
