<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BudgetAlertMail;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        // ✅ 1. Validate
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'expense_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        // ✅ 2. Save expense
        Expense::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'category' => $request->category,
            'expense_date' => $request->expense_date,
            'note' => $request->note,
        ]);

        $this->checkBudgetAlerts(auth()->user());

        return back()->with('success', 'Expense added');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'expense_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);
        
        $expense->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'category' => $request->category,
            'expense_date' => $request->expense_date,
            'note' => $request->note,
        ]);

        $this->checkBudgetAlerts(auth()->user());

        return back()->with('success', 'Expense updated successfully');
    }

    public function destroy($id)
    {
        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);
        $expense->delete();

    return redirect()->back()->with('success', 'Expense deleted successfully.');
}
    public function storeFromBpay(Request $request)
    {
        $request->validate([
            'amount'   => 'required|numeric|min:1',
            'category' => 'required|string|max:50',
            'payment_method' => 'required|in:wallet,upi',
        ]);

        $user = auth()->user();
        
        if ($request->payment_method === 'wallet') {
            $wallet = \App\Models\Wallet::firstOrCreate(
                ['user_id' => $user->id],
                ['balance' => 0]
            );

            if ($wallet->balance < $request->amount) {
                return redirect()->back()->with('error', 'Payment failed: Low wallet balance. Please top up your wallet first.');
            }

            // Explicitly Deduct balance from Wallet Top-Up
            $wallet->decrement('balance', $request->amount);

            // Record Transaction
            $wallet->transactions()->create([
                'type'        => 'debit',
                'amount'      => $request->amount,
                'description' => 'Bpay out: ' . ucfirst($request->category),
            ]);
            
            $note = 'Paid via Bpay Wallet';
            $successMsg = 'Bpay payment successful! Wallet debited and expense marked.';
            
        } else {
            // UPI Payment Route
            $note = 'Paid via External UPI';
            $successMsg = 'UPI expense successfully recorded in your budget.';
        }

        // Add to expenses
        $user->expenses()->create([
            'title'        => 'Payment',
            'amount'       => $request->amount,
            'category'     => strtolower($request->category),
            'expense_date' => now()->toDateString(),
            'note'         => $note,
        ]);

        $this->checkBudgetAlerts($user);

        return redirect()->route('dashboard')->with('success', $successMsg);
    }

    private function checkBudgetAlerts($user)
    {
        $monthlyBudget = $user->monthly_budget ?? 0;

        if ($monthlyBudget > 0) {
            $totalSpent = \App\Models\Expense::where('user_id', $user->id)->sum('amount');
            $usagePercent = round(($totalSpent / $monthlyBudget) * 100);

            if ($usagePercent >= 50 && !$user->alert_50_sent) {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\BudgetAlertMail(50, $usagePercent));
                $user->update(['alert_50_sent' => true]);
            }

            if ($usagePercent >= 90 && !$user->alert_90_sent) {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\BudgetAlertMail(90, $usagePercent));
                $user->update(['alert_90_sent' => true]);
            }

            if ($usagePercent >= 100 && !$user->alert_100_sent) {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\BudgetAlertMail(100, $usagePercent));
                $user->update(['alert_100_sent' => true]);
            }
        }
    }
}
