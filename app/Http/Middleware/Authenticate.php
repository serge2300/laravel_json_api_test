<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Errors;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if a token is provided
        if (!$request->hasCookie('token')) {
            return Response::json(Errors::get(['TOKEN_REQUIRED']));
        }
        // Check if a user is authenticated
        if (!Auth::check()) {
            return Response::json(Errors::get(['BAD_TOKEN']));
        }

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest('login');
        }

        return $next($request);
    }
}
