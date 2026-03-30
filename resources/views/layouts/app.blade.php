<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BudgetBeam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/png" sizes="64x64" href="/favicon-64x64.png">
<link rel="shortcut icon" href="/favicon.ico">
    {{-- Theme styles --}}
    <style>
        /* Eye-Strain Friendly Light Mode */
        body:not(.dark) {
            background-color: #F8FAFC; 
            color: #334155; 
        }

        body:not(.dark) .navbar {
            background-color: #FFFFFF !important;
            border-bottom: 1px solid #E2E8F0 !important;
        }

        body:not(.dark) .card {
            background-color: #FFFFFF;
            color: #334155;
            border: 1px solid #F1F5F9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        body:not(.dark) .modal-content {
            background-color: #FFFFFF;
            color: #334155;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body:not(.dark) .text-muted {
            color: #64748B !important;
        }

        body:not(.dark) .form-control {
            background-color: #FFFFFF;
            border-color: #E2E8F0;
            color: #334155;
        }

        body:not(.dark) .form-control:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        }

        /* Dark mode */
        body.dark {
            background-color: #0B1120;
            color: #F8FAFC;
        }

        body.dark .navbar {
            background-color: #0B1120 !important;
            border-bottom: 1px solid #1E293B !important;
        }

        body.dark .card {
            background-color: #131B2F;
            color: #F8FAFC;
            border: 1px solid #1E293B;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
        }

        body.dark .text-muted {
            color: #94A3B8 !important;
        }

        body.dark .modal-content {
            background-color: #131B2F;
            color: #F8FAFC;
            border: 1px solid #1E293B;
        }

        body.dark .form-control {
            background-color: #0B1120;
            border-color: #1E293B;
            color: #F8FAFC;
        }

        body.dark .form-control:focus {
            background-color: #0B1120;
            border-color: #10B981;
            color: #F8FAFC;
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        }

        body.dark .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

.day-name {
    text-align: center;
    font-size: 12px;
    color: #6b7280;
    font-weight: 600;
}

.day {
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    text-align: center;
    cursor: pointer;
    background: white;
}

.day:hover {
    background: #f1f5f9;
}

.day.today {
    background: #4f46e5;
    color: white;
    font-weight: bold;
}

/* ===== THEME TOGGLE SWITCH (SUN / MOON) ===== */
.theme-toggle {
    display: flex;
    align-items: center;
}

.toggle-label {
    width: 64px;
    height: 28px;
    background: #e5e7eb;
    border-radius: 999px;
    position: relative;
    cursor: pointer;
    transition: background 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 6px;
    box-sizing: border-box;
}

.toggle-ball {
    width: 24px;
    height: 24px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    left: 2px;
    transition: transform 0.3s ease;
    z-index: 2;
}

/* Icons */
.icon {
    font-size: 14px;
    z-index: 1;
    transition: opacity 0.3s ease;
}

.sun {
    opacity: 1;
}

.moon {
    opacity: 0.4;
}

/* DARK MODE */
body.dark .toggle-label {
    background: #f2f1fb;
}

body.dark .toggle-ball {
    transform: translateX(36px);
}

body.dark .sun {
    opacity: 0.4;
}

body.dark .moon {
    opacity: 1;
}

#themeToggle {
    display: none;
}

.brand-logo {
    height: 44px;
    width: auto;
}

.brand-text {
    font-size: 1.25rem;
    font-weight: 800;
    background: linear-gradient(90deg, #2563EB 0%, #10B981 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}

/* Floating Pay Pill */
.bpay-pill {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 40px;
    border-radius: 999px;
    background: #ffffff;
    border: 2px solid #1a73e8;
    color: #1a73e8;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 10px 22px rgba(26,115,232,0.18);
    transition: all 0.2s ease;
}

.bpay-pill:hover {
    background: #1a73e8;
    color: #fff;
    box-shadow: 0 14px 30px rgba(26,115,232,0.35);
    transform: translateY(-2px);
}

/* Bpay logo circle */
.bpay-logo {
    width: 34px;
    height: 34px;
    background: #1a73e8;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.bpay-pill:hover .bpay-logo {
    background: #fff;
    color: #1a73e8;
}

    </style>

    @stack('styles')
</head>

<body>

<nav class="navbar navbar-light bg-white border-bottom px-4 d-flex align-items-center">

    <!-- BRAND -->
    <a href="/dashboard"
   class="navbar-brand d-flex align-items-center gap-2 fw-bold text-decoration-none">

    <img
    src="{{ asset('images/budgetbeam-logo.png') }}"
    alt="BudgetBeam"
    class="brand-logo"
>

    <span class="brand-text">BudgetBeam</span>
</a>





@auth
    <button class="btn btn-link fw-semibold text-decoration-none text-dark"
            data-bs-toggle="modal"
            data-bs-target="#walletModal">
        Wallet
    </button>
@endauth



    <!-- RIGHT SIDE -->
    <div class="ms-auto d-flex align-items-center gap-2">

        <!-- THEME TOGGLE -->
        <div class="theme-toggle">
            <input type="checkbox" id="themeToggle">
            <label for="themeToggle" class="toggle-label">
                <span class="icon sun">☀️</span>
                <span class="icon moon">🌙</span>
                <span class="toggle-ball"></span>
            </label>
        </div>

        @auth
        <div class="dropdown d-flex align-items-center gap-2">
            <img
                src="{{ auth()->user()->avatar
                        ? asset('storage/' . auth()->user()->avatar)
                        : 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><rect width=\"100\" height=\"100\" fill=\"#0d6efd\"/><text x=\"50\" y=\"50\" font-family=\"Arial\" font-size=\"40\" fill=\"#fff\" text-anchor=\"middle\" dominant-baseline=\"central\">' . strtoupper(substr(auth()->user()->name, 0, 1)) . '</text></svg>')
                }}"
                class="rounded-circle"
                width="32"
                height="32"
                style="object-fit: cover;"
                alt="Profile"
            >

            <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                {{ auth()->user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/dashboard">🏠 Dashboard</a></li>
                <li><a class="dropdown-item" href="/settings">⚙️ Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth

        @guest
        <div class="d-flex align-items-center gap-2 ms-2">
            <a href="/login" class="btn btn-outline-secondary fw-semibold btn-sm px-3">Login</a>
            <a href="/register" class="btn btn-primary fw-semibold btn-sm px-3">Sign Up</a>
        </div>
        @endguest

    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

{{-- ✅ Dark mode logic (FIXED) --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('themeToggle');
    const body = document.body;

    // Load saved theme
    
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark');
    toggle.checked = true;
}

toggle.addEventListener('change', () => {
    body.classList.toggle('dark');

    localStorage.setItem(
        'theme',
        body.classList.contains('dark') ? 'dark' : 'light'
    );
});

    const modal = document.getElementById('calendarModal');
    const grid = document.getElementById('calendarGrid');
    const label = document.getElementById('monthLabel');
    const prev = document.getElementById('prevMonth');
    const next = document.getElementById('nextMonth');

    if (!modal) return;

    let date = new Date();
    const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

    function renderCalendar() {
        grid.innerHTML = '';

        const year = date.getFullYear();
        const month = date.getMonth();

        label.textContent = date.toLocaleString('default', {
            month: 'long',
            year: 'numeric'
        });

        // Day headers
        days.forEach(d => {
            const el = document.createElement('div');
            el.className = 'day-name';
            el.textContent = d;
            grid.appendChild(el);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        for (let i = 0; i < firstDay; i++) {
            grid.appendChild(document.createElement('div'));
        }

        for (let d = 1; d <= totalDays; d++) {
            const el = document.createElement('div');
            el.className = 'day';
            el.textContent = d;

            if (
                d === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                el.classList.add('today');
            }

            el.addEventListener('click', () => {
                console.log(
                    `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`
                );
            });

            grid.appendChild(el);
        }
    }

    modal.addEventListener('shown.bs.modal', renderCalendar);
    prev.addEventListener('click', () => { date.setMonth(date.getMonth() - 1); renderCalendar(); });
    next.addEventListener('click', () => { date.setMonth(date.getMonth() + 1); renderCalendar(); });
});
</script>

<!-- 📅 Calendar Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Calendar</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-sm btn-outline-secondary" id="prevMonth">‹</button>
                    <strong id="monthLabel"></strong>
                    <button class="btn btn-sm btn-outline-secondary" id="nextMonth">›</button>
                </div>

                <div id="calendarGrid" class="calendar-grid"></div>
            </div>

        </div>
    </div>
</div>


<!--Wallet_Modal-->    
    @auth
<div class="modal fade" id="walletModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <h3 class="mb-0">₹{{ number_format(auth()->user()->wallet?->balance ?? 0) }}</h3>
                <p class="text-muted mb-3">Available balance</p>

                <hr>

                <form method="GET" action="{{ route('wallet.payment') }}">
    <label class="form-label">Top Up Amount</label>
    <input
        type="number"
        name="amount"
        min="1"
        required
        class="form-control mb-2">

    <button class="btn btn-primary w-100">
        Continue
    </button>
</form>

               

            </div>

        </div>
    </div>
</div>

@endauth
</body>
</html>