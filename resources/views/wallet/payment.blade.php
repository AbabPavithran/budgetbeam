@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h4 class="mb-3">Add ₹{{ $amount }} to Wallet</h4>

    <form method="POST" action="{{ route('wallet.confirm') }}">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">

        <div class="list-group mb-3">

            <label class="list-group-item">
                <input type="radio" name="method" value="upi" required>
                UPI (Google Pay / PhonePe / Paytm)
            </label>

            <label class="list-group-item">
                <input type="radio" name="method" value="bank">
                Net Banking
            </label>

            <label class="list-group-item">
                <input type="radio" name="method" value="card">
                Debit / Credit Card
            </label>

        </div>

        <button class="btn btn-success w-100">
            Pay ₹{{ $amount }}
        </button>
    </form>

</div>
@endsection