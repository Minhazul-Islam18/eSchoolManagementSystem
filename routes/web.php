<?php

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\FrontendPageComponent;
use App\Livewire\Backend\RoleManagement;
use App\Http\Controllers\ProcessFreePackage;
use App\Livewire\Backend\DashboardComponent;
use App\Http\Controllers\backend\SocialLogin;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\FrontendPageController;

Route::get('/', function () {
    $pricings = Package::where('status', 1)->get();
    return Inertia::render('Home', [
        'pricings' => $pricings,
        'school' => auth()->user()?->school ?? []
    ]);
})->name('/');
Route::get('/under-development', function () {
    return 'This feature is under development phrase';
})->name('under-development');

Route::get('contact', function () {
    return Inertia::render('Contact');
})->name('contact');
Route::get('pricings', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user && $user->subscription) {
            if (Carbon::parse($user->subscription->will_expire)->isFuture()) {
                Inertia::share('is_subscription_active', true);
            } else {
                Inertia::share('is_subscription_active', false);
            }
        } else {
            Inertia::share('is_subscription_active', false);
        }
    } else {
        Inertia::share('is_subscription_active', 'not_authenticated');
    }

    $pricings = Package::where('status', 1)->get();
    return Inertia::render('Pricings', [
        'pricings' => $pricings,
        'school' => auth()->user()?->school ?? []
    ]);
})->name('pricings');
Route::get('subscription-expired', function () {
    return Inertia::render(
        'ProfileLocked',
        [
            'image' => 'https://i.ibb.co/Tt6TpsD/13677898-5143410.jpg'
        ]
    );
})->name('subscription-expired');

Route::get('account-status', function () {
    return view('auth.account-status');
})->name('account-status');

Route::group(['middleware' => ['auth']], function () {




    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class, 'index']);
    Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class, 'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class, 'callBack'])->name('bkash-callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class, 'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class, 'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class, 'refundStatus'])->name('bkash-refund-status');


    Route::get('/process-free-package', [ProcessFreePackage::class, 'SyncToUser'])->name('process-free-package');

    // Payment Routes for bKash
    // Route::get('/bkash/payment', [BkashPaymentController::class, 'index']);
    // Route::post('/bkash/get-token', [BkashPaymentController::class, 'getToken'])->name('bkash-get-token');
    // Route::post('/bkash/create-payment', [BkashPaymentController::class, 'createPayment'])->name('bkash-create-payment');
    // Route::post('/bkash/execute-payment', [BkashPaymentController::class, 'executePayment'])->name('bkash-execute-payment');
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
    if (auth()->user()->role->slug == 'admin' || auth()->user()->role->slug == 'super_admin') {
        return redirect()->route('app.dashboard');
    } elseif (auth()->user()->role->slug == 'school' || auth()->user()->role->slug == "demo_school") {
        return redirect()->route('school.index');
    } elseif (auth()->user()->role->slug == 'student') {
        return redirect()->route('student.index');
    }
    // return redirect('/school/dashboard');
})->name('users-redirection')->middleware(['role.redirect']);

Route::get('/dashboard', function () {
    if (auth()->user()->role->slug == 'admin' || auth()->user()->role->slug == 'super_admin') {
        return redirect()->route('app.index');
    } elseif (auth()->user()->role->slug == 'school' || auth()->user()->role->slug == "demo_school") {
        return redirect()->route('school.index');
    }
})->name('dashboard');
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {

// });

//Social Login
Route::group(['as' => 'login.', 'prefix' => 'login'], function () {
    Route::get('/{driver}', [SocialLogin::class, 'redirect'])->name('social');
    Route::get('/{driver}/callback', [SocialLogin::class, 'callback'])->name('social.callback');
});
//put this line in very last
Route::get('{slug}', FrontendPageComponent::class)->name('frontend-pages');
