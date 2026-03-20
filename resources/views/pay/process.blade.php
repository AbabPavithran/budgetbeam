@extends('layouts.app')

@section('content')
<div class="container py-5 text-center" style="max-width:400px;">

    <h5 class="mb-3">Processing payment</h5>

    <p class="text-muted mb-4">
        Paying ₹{{ $amount }} for {{ ucfirst($category) }}
    </p>

    <div class="spinner-border text-primary mb-4"></div>

    <p class="small text-muted">
        Opening UPI app…
    </p>

</div>

<script>
setTimeout(() => {
    const upiId = "receiver@upi"; // 🔴 replace with your real UPI ID
    const amount = "{{ $amount }}";
    const note = "{{ $category }} payment";
    const name = "Bpay";

    const upiUrl =
        `upi://pay?pa=${upiId}&pn=${name}&am=${amount}&cu=INR&tn=${note}`;

    window.location.href = upiUrl;
}, 800);
</script>
@endsection