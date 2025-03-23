<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\AuthenticateAndRenew;

class JwtMiddleware extends AuthenticateAndRenew
{
    const PARAM_NULLABLE = 'nullable';

    public function handle($request, Closure $next, ...$params)
    {
        try {
            $this->authenticate($request);
        } catch (\Exception $exception) {
            if (
                !in_array(self::PARAM_NULLABLE, $params)
                || $request->hasHeader('authorization')
            ) {
                throw $exception;
            }
        }

        return $next($request);
    }
}
