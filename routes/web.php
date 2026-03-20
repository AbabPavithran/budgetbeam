<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordOtpController;
use App\Http\Controllers\WalletController;
/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Password reset
|--------------------------------------------------------------------------
*/


Route::get('/forgot-password', [PasswordOtpController::class, 'request'])
    ->middleware('guest')
    ->name('otp.password.request');

Route::get('/bpay/process', function (Illuminate\Http\Request $request) {
    return view('pay.process', [
        'amount' => $request->amount,
        'category' => $request->category,
    ]);
})->middleware('auth')->name('bpay.process');


Route::post('/forgot-password', [PasswordOtpController::class, 'sendOtp'])
    ->middleware('guest')
    ->name('otp.password.send');

Route::get('/verify-otp', [PasswordOtpController::class, 'verifyForm'])
    ->middleware('guest')
    ->name('otp.verify.form');

Route::post('/verify-otp', [PasswordOtpController::class, 'verifyOtp'])
    ->middleware('guest')
    ->name('otp.verify');

Route::get('/reset-password-otp', [PasswordOtpController::class, 'resetForm'])
    ->middleware('guest')
    ->name('otp.password.reset.form');

Route::post('/reset-password-otp', [PasswordOtpController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('otp.password.reset');

    Route::middleware('auth')->group(function () {
    Route::post('/wallet/topup', [WalletController::class, 'topUp'])
        ->name('wallet.topup');

    Route::get('/wallet/payment', [WalletController::class, 'payment'])
    ->middleware('auth')
    ->name('wallet.payment');

Route::post('/wallet/confirm', [WalletController::class, 'confirmPayment'])
    ->middleware('auth')
    ->name('wallet.confirm');

   
Route::post('/bpay/expense', [ExpenseController::class, 'storeFromBpay'])
    ->middleware('auth')
    ->name('bpay.expense');
});
/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/


// Deprecated and unsafe debug routes removed.

Route::get('/pay/type', function () {
    return view('pay.type');
})->name('pay.type');



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/expenses', [ExpenseController::class, 'store'])
        ->name('expenses.store');
    
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])
        ->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])
        ->name('expenses.destroy');    

    Route::get('/calendar', function () {
        return view('calendar');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::post('/settings/profile', [ProfileController::class, 'update']);
    Route::post('/settings/password', [PasswordController::class, 'update']);
    Route::post('/settings/theme', [ThemeController::class, 'update']);

    Route::post('/theme', function () {
        auth()->user()->update([
            'theme' => request('theme')
        ]);

        return response()->json(['ok' => true]);
    });





    
});


Route::middleware('auth')->group(function () {
    Route::post('/set-budget', function () {
        request()->validate([
            'monthly_budget' => 'required|numeric|min:0'
        ]);

        auth()->user()->update([
            'monthly_budget'   => request('monthly_budget'),
            'alert_50_sent'    => false,
            'alert_90_sent'    => false,
            'alert_100_sent'   => false,
        ]);

        return back()->with('budget_set', 'Monthly budget updated');
    });
});



