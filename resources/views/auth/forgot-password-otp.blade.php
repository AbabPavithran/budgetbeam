@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">

            <h5 class="fw-bold mb-2">Forgot Password</h5>
            <p class="text-muted mb-4">
                Enter your email and we’ll send you a reset link.
            </p>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/forgot-password">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <button class="btn btn-primary w-100">
                    Send OTP
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="/login" class="text-muted">
                    Back to login
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
