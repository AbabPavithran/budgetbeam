<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'ababpavithran2003@gmail.com')->first();
if ($user) {
    auth()->login($user);
}

try {
    \Illuminate\Support\Facades\View::share('errors', new \Illuminate\Support\MessageBag);
    echo view('settings')->render();
} catch (\Exception $e) {
    echo "ERROR Rendering View: " . $e->getMessage();
} catch (\Throwable $t) {
    echo "FATAL ERROR Rendering View: " . $t->getMessage();
}
