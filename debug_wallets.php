<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$wallets = App\Models\Wallet::all();
foreach ($wallets as $wallet) {
    echo "ID: $wallet->id, User ID: $wallet->user_id, Balance: $wallet->balance\n";
}

$transactions = App\Models\WalletTransaction::all();
foreach ($transactions as $t) {
    echo "TxID: $t->id, WalletID: $t->wallet_id, Type: $t->type, Amount: $t->amount\n";
}
