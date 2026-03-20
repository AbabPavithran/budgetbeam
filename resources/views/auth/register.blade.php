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
                            <p class="text-muted mt-2 px-3">Track every rupee. Stop financial surprises at the end of the month.</p>
                        </div>
                    </div>

                    <!-- RIGHT SIDE (FORM) -->
                    <div class="col-md-7 p-4 p-sm-5">
                        <div class="mb-4 pb-2">
                            <h2 class="fw-bold mb-0">Create account</h2>
                        </div>

                        <form method="POST" action="/register">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-medium small">Full Name *</label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-3" required style="font-size: 0.95rem;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium small">Email address *</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-3" required style="font-size: 0.95rem;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium small">Password *</label>
                                <input type="password" name="password" class="form-control form-control-lg rounded-3" required style="font-size: 0.95rem;">
                            </div>
                            
                            <div class="form-check mb-4 mt-3">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label text-muted small ps-1" for="termsCheck">
                                    I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>.
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg rounded-3 fw-bold shadow-sm mt-2" style="letter-spacing: 0.5px;">
                                Create
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
