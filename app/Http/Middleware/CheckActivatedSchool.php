<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActivatedSchool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() != null &&  auth()->user()->status !== 0) {
            throw new Exception("Your Account isn't activated or approved by authority!", 1);
            return $next($request);

            // return to_route('account-status');
        }
        return redirect()->route('account-status');
    }
}
