<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->subscription) {
            $expirationDate = Carbon::parse($user->subscription->will_expire);

            // Check if the subscription is still active
            if ($expirationDate->isFuture()) {
                return $next($request);
            }
        }

        // Redirect or handle unauthorized user
        return redirect()->route('subscription-expired');
    }
}
