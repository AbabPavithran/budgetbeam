<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    // 🔹 Top up wallet balance + log transaction
    public function topUp(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = auth()->user()->wallet;

        // Safety check (optional, but wise)
        if (!$wallet) {
            return back()->withErrors('Wallet not found.');
        }

        // 1️⃣ Update balance
        $wallet->increment('balance', $request->amount);

        // 2️⃣ Store transaction history
        $wallet->transactions()->create([
            'type' => 'credit',
            'amount' => $request->amount,
            'description' => 'Wallet top-up',
        ]);

        return back();
    }
    public function index()
{
    $wallet = auth()->user()->wallet;
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

    $wallet = auth()->user()->wallet;

    if (!$wallet) {
        return redirect()->route('dashboard')->with('error', 'Critical Error: Wallet not found for this user.');
    }

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