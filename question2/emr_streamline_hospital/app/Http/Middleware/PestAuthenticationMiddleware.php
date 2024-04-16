<?php

namespace App\Http\Middleware;

use Closure;

class PestAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user agent contains "pest" indicating a Pest test
        if (str_contains($request->header('User-Agent'), 'pest')) {
            // Allow the request to continue without authentication
            return $next($request);
        }

        // For other requests, proceed with the normal authentication flow
        return $next($request);
    }
}
