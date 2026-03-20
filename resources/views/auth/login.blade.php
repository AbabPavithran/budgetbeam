@extends('layouts.app')

@section('content')
<div class="container mt-2 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <div class="row g-0">
                    
                    <!-- LEFT SIDE (BRANDING / ICON) -->
                    <div class="col-md-5 d-none d-md-flex flex-column justify-content-center align-items-center p-5 position-relative" style="background: linear-gradient(135deg, rgba(37,99,235,0.05) 0%, rgba(37,99,235,0.1) 100%);">
                        <div class="position-relative text-center z-1">
                            <img src="{{ asset('images/budgetbeam-logo.png') }}" class="img-fluid mb-4 bg-white rounded-circle p-3 shadow-sm" style="max-width: 180px;" alt="BudgetBeam Tracker">
                            <h3 class="fw-bold mt-2" style="letter-spacing: -0.5px;">BudgetBeam</h3>
                            <p class="text-muted mt-2 px-3">Welcome back! Log in to check your latest tracking insights.</p>
                        </div>
                    </div>

                    <!-- RIGHT SIDE (FORM) -->
                    <div class="col-md-7 p-4 p-sm-5 d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
                            <h2 class="fw-bold mb-0">Sign in</h2>
                            <a href="/register" class="text-decoration-none fw-semibold small text-primary">Sign up</a>
                        </div>

                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-medium small">Email address</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-3" required style="font-size: 0.95rem;">
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label fw-medium small">Password</label>
                                    <a href="/forgot-password" class="text-decoration-none fw-semibold small text-primary">Forgot your password?</a>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg rounded-3" required style="font-size: 0.95rem;">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg rounded-3 fw-bold shadow-sm mt-4" style="letter-spacing: 0.5px;">
                                Login
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
