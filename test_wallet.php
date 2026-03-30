<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'ababpavithran2003@gmail.com')->first();
if (!$user) {
    echo "User not found\n";
    exit;
}

// Ensure wallet exists
if (!$user->wallet) {
    $user->wallet()->create(['balance' => 0]);
    $user->refresh();
}

$wallet = $user->wallet;
echo "Initial Balance: " . $wallet->balance . "\n";

// Top up 500
$wallet->increment('balance', 500);
$wallet->refresh();
echo "After Topup 500: " . $wallet->balance . "\n";

// Spend 100
$wallet->decrement('balance', 100);
$wallet->refresh();
echo "After Spend 100: " . $wallet->balance . "\n";
