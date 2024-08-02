<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class HandleUnauthorizedException
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (UnauthorizedException $exception) {
            return response()->json([
                'message' => 'You do not have permission to access this route.',
                'status' => 'error',
            ], 403);
        }
    }
}
