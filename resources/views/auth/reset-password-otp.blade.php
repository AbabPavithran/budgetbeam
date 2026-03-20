@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">

            <h5 class="fw-bold mb-2">Reset Password</h5>
            <p class="text-muted mb-4">
                Create a new password to secure your account.
            </p>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('otp.password.reset') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter new password"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm new password"
                           required>
                </div>

                <button class="btn btn-primary w-100">
                    Reset Password
                </button>
            </form>

        </div>
    </div>
</div>
@endsection