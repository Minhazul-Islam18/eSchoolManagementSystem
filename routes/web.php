<?php

use App\Http\Controllers\backend\SocialLogin;
use App\Http\Controllers\FrontendPageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\RoleManagement;
use App\Livewire\Backend\DashboardComponent;
use App\Livewire\FrontendPageComponent;

Route::get('/admin-login', function () {
    $e = Auth::loginUsingId(1, $remember = true);
    if ($e) {
        return redirect('/');
    }
});
Route::get('/school-login', function () {
    Auth::logout();
    $e = Auth::loginUsingId(4, $remember = true);
    if ($e) {
        return redirect('/');
    }
});

Route::get('/users-redirection', function () {
    dd('ok');
})->name('users-redirection')->middleware(['role.redirect']);
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//Social Login
Route::group(['as' => 'login.', 'prefix' => 'login'], function () {
    Route::get('/{driver}', [SocialLogin::class, 'redirect'])->name('social');
    Route::get('/{driver}/callback', [SocialLogin::class, 'callback'])->name('social.callback');
});
//put this line in very last
Route::get('{slug}', FrontendPageComponent::class)->name('frontend-pages');
