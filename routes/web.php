<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\FrontendPageComponent;
use App\Livewire\Backend\RoleManagement;
use App\Livewire\Backend\DashboardComponent;
use App\Http\Controllers\backend\SocialLogin;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\ProcessFreePackage;

Route::get('/', function () {
    // dd(auth()->user()->school);
    Inertia::share('logo', setting('logo'));
    $pricings = Package::where('status', 1)->get();
    return Inertia::render('Home', [
        'pricings' => $pricings,
        'school' => auth()->user()->school->toArray() ?? []
    ]);
})->name('/');
Route::group(['middleware' => ['auth']], function () {
    Route::put('/process-free-package/{id}', [ProcessFreePackage::class, 'SyncToUser'])->name('process-free-package');

    // Payment Routes for bKash
    Route::get('/bkash/payment', [BkashPaymentController::class, 'index']);
    Route::post('/bkash/get-token', [BkashPaymentController::class, 'getToken'])->name('bkash-get-token');
    Route::post('/bkash/create-payment', [BkashPaymentController::class, 'createPayment'])->name('bkash-create-payment');
    Route::post('/bkash/execute-payment', [BkashPaymentController::class, 'executePayment'])->name('bkash-execute-payment');
    // Route::get('/bkash/query-payment', [BkashPaymentController::class, 'queryPayment'])->name('bkash-query-payment');
    // Route::post('/bkash/success', [BkashPaymentController::class, 'bkashSuccess'])->name('bkash-success');

    // // Refund Routes for bKash
    // Route::get('/bkash/refund', [BkashPaymentController::class, 'refundPage'])->name('bkash-refund');
    // Route::post('/bkash/refund', [BkashPaymentController::class, 'refund'])->name('bkash-refund');
});

Route::get('/admin-login', function () {
    $e = Auth::loginUsingId(1, $remember = true);
    if ($e) {
        return redirect('/app/dashboard');
    }
});
Route::get('/school-login', function () {
    Auth::logout();
    $e = Auth::loginUsingId(4, $remember = true);
    if ($e) {
        return redirect('/school/dashboard');
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
