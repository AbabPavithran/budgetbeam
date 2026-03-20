@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">

            <h5 class="fw-bold mb-2">Verify OTP</h5>
            <p class="text-muted mb-4">
                Enter the 6-digit OTP sent to your email.
            </p>

            {{-- Status --}}
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/verify-otp">
                @csrf

                <div class="mb-3">
                    <label class="form-label">OTP</label>
                    <input type="text"
                           name="otp"
                           class="form-control text-center fw-bold"
                           maxlength="6"
                           required
                           autofocus>
                </div>

                <button class="btn btn-primary w-100">
                    Verify OTP
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
