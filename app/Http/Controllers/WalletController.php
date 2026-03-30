<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    // 🔹 Top up wallet balance + log transaction
    // 🔹 Top up wallet balance + log transaction
    public function topUp(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = \App\Models\Wallet::firstOrCreate(
            ['user_id' => auth()->id()],
            ['balance' => 0]
        );

        // 1️⃣ Update balance
        $wallet->increment('balance', $request->amount);

        // 2️⃣ Store transaction history
        $wallet->transactions()->create([
            'type' => 'credit',
            'amount' => $request->amount,
            'description' => 'Wallet top-up',
        ]);

        return back()->with('success', 'Wallet topped up successfully');
    }
    public function index()
{
    $wallet = \App\Models\Wallet::firstOrCreate(
        ['user_id' => auth()->id()],
        ['balance' => 0]
    );
    return view('wallet.index', compact('wallet'));
}
public function payment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    return view('wallet.payment', [
        'amount' => $request->amount
    ]);
}

public function confirmPayment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'method' => 'required|in:upi,bank,card',
    ]);

    $wallet = \App\Models\Wallet::firstOrCreate(
        ['user_id' => auth()->id()],
        ['balance' => 0]
    );

    // Simulate successful payment
    $wallet->increment('balance', $request->amount);

    $wallet->transactions()->create([
        'type' => 'credit',
        'amount' => $request->amount,
        'description' => strtoupper($request->method) . ' top-up',
    ]);

    return redirect()->route('dashboard')->with('success', 'Wallet topped up successfully');
}
}