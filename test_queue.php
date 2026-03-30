<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$jobsCount = \Illuminate\Support\Facades\DB::table('jobs')->count();
$failedJobsCount = \Illuminate\Support\Facades\Schema::hasTable('failed_jobs') ? \Illuminate\Support\Facades\DB::table('failed_jobs')->count() : 0;

echo "Pending Jobs: $jobsCount\n";
echo "Failed Jobs: $failedJobsCount\n";
