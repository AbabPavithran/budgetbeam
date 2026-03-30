<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = App\Models\User::all();
foreach ($users as $user) {
    $wallets = App\Models\Wallet::where('user_id', $user->id)
        ->orderBy('updated_at', 'desc')
        ->get();
        
    if ($wallets->count() > 1) {
        $keep = $wallets->first();
        foreach ($wallets as $wallet) {
            if ($wallet->id !== $keep->id) {
                $keep->balance += $wallet->balance;
                $keep->save();
                
                // reassign transactions just in case
                App\Models\WalletTransaction::where('wallet_id', $wallet->id)
                    ->update(['wallet_id' => $keep->id]);
                    
                $wallet->delete();
                echo "Merged wallet {$wallet->id} into {$keep->id}\n";
            }
        }
    }
}
echo "Cleanup complete.\n";
