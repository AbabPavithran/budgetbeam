@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-5 mb-5 mt-4">
    <div class="row align-items-center g-5">

        <!-- LEFT -->
        <div class="col-md-6 pe-lg-5">
            <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill fw-semibold">
                Built for everyday people
            </span>
            <h1 class="fw-bold display-4 mb-3" style="letter-spacing: -1px;">
                Where does your salary actually go?
            </h1>

            <p class="text-muted fs-5 mb-4" style="line-height: 1.6;">
                BudgetBeam helps you see every rupee you spend.
                From daily chai to monthly rent, track everything
                and stop financial surprises at the end of the month.
            </p>

            <div class="d-flex flex-column flex-sm-row gap-3">
                <a href="/register" class="btn btn-primary btn-lg px-5 py-3 fw-semibold shadow-sm rounded-3">
                    Start Tracking Free
                </a>
                <a href="/login" class="btn btn-outline-secondary btn-lg px-5 py-3 fw-semibold rounded-3">
                    Login
                </a>
            </div>

            <div class="mt-4 d-flex align-items-center gap-2 text-muted small fw-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                No financial jargon. Just simple tracking.
            </div>
        </div>

        <!-- RIGHT (Realistic Budget Preview) -->
        <div class="col-md-6">
            <div class="card border-0 p-4" style="border-radius: 20px;">
                
                <p class="text-muted small fw-bold text-uppercase mb-1">Monthly Budget</p>
                <h3 class="fw-bold mb-4">₹ 45,000</h3>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3">🏠</div>
                        <span class="fw-medium text-dark">Rent</span>
                    </div>
                    <span class="fw-bold text-dark fs-5">₹ 12,000</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success-subtle text-success p-2 rounded-3">🛒</div>
                        <span class="fw-medium text-dark">Groceries</span>
                    </div>
                    <span class="fw-bold text-dark fs-5">₹ 6,200</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning-subtle text-warning p-2 rounded-3">🚗</div>
                        <span class="fw-medium text-dark">Transport</span>
                    </div>
                    <span class="fw-bold text-dark fs-5">₹ 3,800</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-danger-subtle text-danger p-2 rounded-3">📺</div>
                        <span class="fw-medium text-dark">Subscriptions</span>
                    </div>
                    <span class="fw-bold text-dark fs-5">₹ 899</span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <span class="fw-semibold text-muted">Remaining Balance</span>
                    <span class="text-success fw-bold h4 mb-0">₹ 22,101</span>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- OUR STORY / ORIGIN SECTION -->
<section class="py-5 my-5">
    <div class="card border-0 overflow-hidden" style="border-radius: 24px; background: linear-gradient(145deg, rgba(37,99,235,0.05) 0%, rgba(37,99,235,0.0) 100%);">
        <div class="row g-0 align-items-center">
            <div class="col-md-5 p-5 bg-primary text-white d-flex flex-column justify-content-center h-100">
                <span class="text-uppercase fw-bold text-white-50 mb-2" style="letter-spacing: 1px; font-size: 0.85rem;">Why We Built This</span>
                <h2 class="fw-bold display-6 mb-4">Built out of frustration. Designed for simplicity.</h2>
                <p class="fs-5 opacity-75 mb-0" style="font-weight: 300;">
                    Created by a college student who just wanted a digital pocketbook.
                </p>
            </div>
            <div class="col-md-7 p-5">
                <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                    "When I started college, I wanted a simple way to maintain my budget book and track my daily expenses without getting overwhelmed by complex financial jargon. I searched for apps and websites, but everything I found was either too complicated, bloated with unnecessary features, or hiding behind paywalls.
                </p>
                <p class="fs-5 fw-medium text-dark mb-0">
                    I just wanted a clean, fast way to track where my money was going every day. So, I built BudgetBeam. No complex syncs, no subscription traps, and no financial degrees required. Just a simple, beautiful way to track every rupee."
                </p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS (ZIG-ZAG) -->
<section class="py-5 mb-5">
    <div class="text-center mb-5 pb-3">
        <h2 class="fw-bold display-6">Tracking made beautifully simple</h2>
    </div>

    <div class="row align-items-center g-5 mb-5 pb-4">
        <div class="col-md-6 order-2 order-md-1">
            <div class="card border-0 p-5 text-center" style="border-radius: 20px; background-color: rgba(16, 185, 129, 0.1);">
                <div class="display-1">📊</div>
            </div>
        </div>
        <div class="col-md-6 order-1 order-md-2 ps-md-5">
            <h3 class="fw-bold mb-3">Visual insights you actually understand</h3>
            <p class="text-muted fs-5">
                Forget confusing spreadsheets. BudgetBeam automatically generates beautiful, interactive charts that break down exactly where your money goes. Instantly see if you're spending too much on food or transport.
            </p>
        </div>
    </div>

    <div class="row align-items-center g-5 pt-3">
        <div class="col-md-6 pe-md-5">
            <h3 class="fw-bold mb-3">Proactive Budget Alerts</h3>
            <p class="text-muted fs-5">
                Set a monthly budget and let us do the rest. BudgetBeam automatically alerts you when you hit 50%, 90%, and 100% of your budget, so you never accidentally overspend before the month is over.
            </p>
        </div>
        <div class="col-md-6">
            <div class="card border-0 p-5 text-center" style="border-radius: 20px; background-color: rgba(245, 158, 11, 0.1);">
                <div class="display-1">🔔</div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST SECTION -->
<section class="py-5 text-center my-5">
    <h2 class="fw-bold mb-3 display-6">
        Ready to take control of your money?
    </h2>

    <p class="mb-4 fs-5 text-muted px-md-5 max-w-75 mx-auto">
        Join the simple revolution. Built for students, professionals, and anyone who wants to stop financial anxiety. Totally free.
    </p>

    <a href="/register" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">
        Create Your Free Account
    </a>
</section>

<p class="text-center text-muted small mt-5 pb-4">
    BudgetBeam — Know your money. Control your future.
</p>

@endsection