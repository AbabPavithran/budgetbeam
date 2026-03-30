<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \Illuminate\Support\Facades\Mail::raw('This is a test email from BudgetBeam mail diagnostics.', function ($message) {
        $message->to('ababpavithran2003@gmail.com')
                ->subject('BudgetBeam Mail Test');
    });
    echo "Mail dispatched successfully!\n";
} catch (\Exception $e) {
    echo "MAIL EXCEPTION: " . $e->getMessage() . "\n";
}
