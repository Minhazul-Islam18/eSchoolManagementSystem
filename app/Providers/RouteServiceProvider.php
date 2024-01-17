<?php

namespace App\Providers;

use App\Http\Middleware\AdminLayoutMiddleware;
use App\Http\Middleware\CheckActivatedSchool;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\FrontendLayoutMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/users-redirection';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', FrontendLayoutMiddleware::class])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth:sanctum', AdminLayoutMiddleware::class])
                ->prefix('app')
                ->name('app.')
                ->group(base_path('routes/backend.php'));
            Route::middleware(['web', 'auth:sanctum', AdminLayoutMiddleware::class, CheckActivatedSchool::class])
                ->prefix('school')
                ->name('school.')
                ->group(base_path('routes/school.php'));
        });
    }
}
