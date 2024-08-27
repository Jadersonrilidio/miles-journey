<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', Env::get('CORS_ALLOWED_ORIGINS'));
        $response->headers->set('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS");
        $response->headers->set('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");

        return $response;
    }
}
