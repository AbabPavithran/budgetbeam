@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width:600px;">

    <h4 class="mb-4">Choose payment details</h4>

    @if(session('error'))
        <div class="alert alert-danger fw-semibold">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger fw-semibold">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bpay.expense') }}">
        @csrf

        {{-- Amount --}}
        <div class="mb-3">
            <label class="form-label">Amount (₹)</label>
            <input
                type="number"
                name="amount"
                min="1"
                required
                class="form-control"
                placeholder="Enter amount">
        </div>

        {{-- Category --}}
        <div class="mb-4">
            <label class="form-label">Category</label>
            <input
                type="text"
                name="category"
                required
                class="form-control"
                placeholder="e.g. Food, Rent, Petrol">
        </div>

        <div class="list-group mb-4">
            <label class="list-group-item py-3 cursor-pointer">
                <input class="form-check-input me-2" type="radio" name="payment_method" value="wallet" checked>
                BudgetBeam Wallet (Available Balance: ₹{{ number_format(auth()->user()->wallet?->balance ?? 0) }})
            </label>
            <label class="list-group-item py-3 cursor-pointer">
                <input class="form-check-input me-2" type="radio" name="payment_method" value="upi">
                UPI (GPay / PhonePe / Paytm)
            </label>
            <label class="list-group-item py-3 text-muted">
                <input class="form-check-input me-2" type="radio" disabled>
                Debit / Credit Card (Coming Soon)
            </label>
        </div>

        <button type="submit" class="btn btn-success w-100 py-3 fw-bold">
            Pay Securely
        </button>
    </form>

</div>
@endsection