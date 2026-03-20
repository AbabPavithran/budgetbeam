<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  
public function index()
{
    $user = auth()->user();

    // ✅ Greeting logic
    $hour = now()->hour;

    if ($hour < 12) {
        $greeting = 'Good morning';
    } elseif ($hour < 18) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }

    // Expenses
    $expenses = Expense::where('user_id', $user->id)
        ->latest()
        ->get();

    // Calculations (example defaults – adjust if you already have these)
    $monthlyBudget = auth()->user()->monthly_budget ?? 0;
$totalSpent = $expenses->sum('amount');

$remaining = $monthlyBudget - $totalSpent;

$usagePercent = $monthlyBudget > 0
    ? round(($totalSpent / $monthlyBudget) * 100)
    : 0;

    // Category breakdown
    $categories = Expense::where('user_id', $user->id)
        ->selectRaw('category, SUM(amount) as total')
        ->groupBy('category')
        ->get();

    return view('dashboard', compact(
        'greeting',
        'totalSpent',
        'remaining',
        'monthlyBudget',
        'usagePercent',
        'categories',
        'expenses'
    ));
}
}