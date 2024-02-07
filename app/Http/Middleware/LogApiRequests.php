<?php

namespace App\Http\Middleware;

use App\Repositories\ApiRequestRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        ApiRequestRepository::store($request->path(), $request->method());
        return $next($request);
    }
}
