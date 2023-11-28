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
        // dd(auth()->user());
        // abort_if(auth()->user() != null &&  auth()->user()->status === 0, '401', 'Your Account isn\'t activated or approved by authority!');
        if (auth()->user() != null &&  auth()->user()->status === 0) {
            throw new Exception("Your Account isn\'t activated or approved by authority!", 1);
        }
        return $next($request);
    }
}
