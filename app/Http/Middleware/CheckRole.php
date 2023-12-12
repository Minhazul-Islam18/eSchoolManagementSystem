<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        foreach ($roles as $role) {
            if (!$request->user()->hasRole($role)) {
                // dd($role);
                return $next($request);
            }
        }
        // If the user is not authenticated or doesn't have the specified role
        abort(403, 'Unauthorized.');
    }
}
