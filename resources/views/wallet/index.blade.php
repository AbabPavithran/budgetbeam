<div class="wallet-popup">
    <div class="wallet-header">
        <h4>Wallet</h4>
        <span class="close">×</span>
    </div>

    <div class="wallet-content">
        <h3>₹{{ $walletBalance }}</h3>
        <p>Available balance</p>
    </div>
</div>

<form method="POST" action="{{ route('wallet.topup') }}">
    @csrf
    <input type="number" name="amount" min="1" required>
    <button class="btn btn-primary">Top Up</button>
</form>