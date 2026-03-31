<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Wallet;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 1️⃣ Auto-create wallet when user is created
        User::created(function ($user) {
            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
        });

        // 2️⃣ Share wallet balance with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $wallet = \App\Models\Wallet::where('user_id', Auth::id())->first();

                $view->with(
                    'walletBalance',
                    $wallet->balance ?? 0
                );
            }
        });
    }
}