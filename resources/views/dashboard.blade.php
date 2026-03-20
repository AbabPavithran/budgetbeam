@extends('layouts.app')

@section('content')



<!-- GREETING -->
<div class="mb-4">
    <h4 class="fw-bold">
        {{ $greeting ?? 'Hello' }}, {{ auth()->user()->name }} 👋
    </h4>
    <p class="text-muted">
        Here’s a quick look at your finances this month.
    </p>
</div>


<!--bpay-->
{{-- Bpay Floating Pay Pill (entry point to payment type page) --}}
<div class="d-flex justify-content-center my-4">
    <a href="{{ route('pay.type') }}" class="bpay-pill text-decoration-none">
        <span class="bpay-logo">B</span>
        <span class="bpay-text">Pay</span>
    </a>
</div>

<button class="btn btn-primary mb-4"
        data-bs-toggle="modal"
        data-bs-target="#addExpenseModal">
    + Add Expense
</button>

<!--set_budget-->
<button class="btn btn-outline-primary mb-4 ms-2"
        data-bs-toggle="modal"
        data-bs-target="#setBudgetModal">
    Set Budget
</button>


<!-- SUMMARY -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted mb-1">Total Spent</p>
            <h4 class="fw-bold">₹ {{ number_format($totalSpent) }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted mb-1">Remaining Budget</p>
            <h4 class="fw-bold {{ $remaining < 0 ? 'text-danger' : 'text-success' }}">
                ₹ {{ number_format($remaining) }}
            </h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted mb-1">Monthly Budget</p>
            <h4 class="fw-bold">₹ {{ number_format($monthlyBudget) }}</h4>
        </div>
    </div>
</div>

<!-- PROGRESS -->
<div class="card p-4 mb-5">
    <p class="fw-semibold mb-2">Budget usage — {{ $usagePercent }}%</p>
    <div class="progress" style="height:8px;">
        <div class="progress-bar
    {{ $usagePercent > 90
        ? 'bg-danger'
        : ($usagePercent > 70
            ? 'bg-warning'
            : 'bg-success') }}"
             style="width: {{ min($usagePercent, 100) }}%">
        </div>
    </div>
</div>

<!-- CATEGORY + CHART -->
<div class="row g-4 mb-5">

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">Category Breakdown</h6>

            @forelse($categories as $item)
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-capitalize">{{ $item->category }}</span>
                    <span class="fw-semibold">₹ {{ number_format($item->total) }}</span>
                </div>
            @empty
                <p class="text-muted">No expenses yet.</p>
            @endforelse
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">Spending Distribution</h6>
            <canvas id="categoryChart" height="220"></canvas>
        </div>
    </div>

</div>

<!-- RECENT -->
<div class="card p-4 mb-5">
    <h6 class="fw-bold mb-3">Recent Transactions</h6>

    @forelse(($expenses ?? collect())->take(5) as $expense)
<div class="d-flex justify-content-between align-items-center py-2 border-bottom">

    <div>
        <div class="fw-semibold">{{ $expense->title }}</div>
        <div class="d-flex align-items-center gap-2 mt-1">
            <small class="text-muted mb-0">
                {{ ucfirst($expense->category) }} · {{ $expense->created_at->format('d M') }}
            </small>
            
            @if(str_contains(strtolower($expense->note ?? ''), 'bpay wallet'))
                <span class="badge bg-primary-subtle text-primary rounded-pill border border-primary-subtle" style="font-size: 0.65rem; padding: 0.25rem 0.5rem;">BudgetBeam Wallet</span>
            @elseif(str_contains(strtolower($expense->note ?? ''), 'upi'))
                <span class="badge bg-success-subtle text-success rounded-pill border border-success-subtle" style="font-size: 0.65rem; padding: 0.25rem 0.5rem;">UPI Transfer</span>
            @endif
        </div>
    </div>

    <div class="d-flex align-items-center gap-2">

        <span class="fw-bold">₹ {{ number_format($expense->amount) }}</span>

        <!-- Edit -->
        <button class="btn btn-sm btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#editExpenseModal{{ $expense->id }}">
            Edit
        </button>

        <!-- Delete (RED) -->
        <form method="POST"
              action="{{ route('expenses.destroy', $expense->id) }}"
              onsubmit="return confirm('Delete this expense?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">
                Delete
            </button>
        </form>

    </div>
</div>
    @empty
        <p class="text-muted">No transactions yet.</p>
    @endforelse
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ✅ REQUIRED for Chart.js v4
    Chart.register(ChartDataLabels);

    const el = document.getElementById('categoryChart');
    if (!el) return;

    const labels = @json($categories->pluck('category'));
    const values = @json($categories->pluck('total'));

    if (!labels.length) return;

    new Chart(el, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#6366f1',
                    '#22c55e',
                    '#f97316',
                    '#ef4444',
                    '#0ea5e9',
                    '#a855f7'
                ]
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12 }
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    formatter: (value, context) => {
                        const data = context.chart.data.datasets[0].data;
                        const total = data.reduce((a, b) => a + b, 0);
                        const percentage = (value / total) * 100;
                        return percentage > 5 ? percentage.toFixed(1) + '%' : '';
                    }
                }
            }
        }
    });
});
</script>
<script>
function bpayNow() {
    const upiId = "receiver@upi"; // replace
    const amount = 100;           // demo / fixed
    const name = "Bpay";
    const note = "Payment";

    const upiUrl =
        `upi://pay?pa=${upiId}&pn=${name}&am=${amount}&cu=INR&tn=${note}`;

    window.location.href = upiUrl;
}
</script>
@endpush

<!--expense modal-->

<div class="modal fade" id="addExpenseModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="/expenses" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add Expense</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expense Date</label>
                    <input type="date" name="expense_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save Expense</button>
            </div>

        </form>
    </div>
</div>


<!-- SET BUDGET MODAL -->
<div class="modal fade" id="setBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="/set-budget" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Set Monthly Budget</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Monthly Budget (₹)</label>
                    <input type="number"
                           name="monthly_budget"
                           step="0.01"
                           class="form-control"
                           value="{{ auth()->user()->monthly_budget }}"
                           required>
                </div>

                <p class="text-muted small">
                    You can update this anytime.
                </p>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-primary">
                    Save Budget
                </button>
            </div>

        </form>
    </div>
</div>




{{-- EDIT EXPENSE MODALS --}}
@foreach($expenses as $expense)
<div class="modal fade" id="editExpenseModal{{ $expense->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ route('expenses.update', $expense->id) }}"
              class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Expense</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title"
                           class="form-control"
                           value="{{ $expense->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01"
                           name="amount"
                           class="form-control"
                           value="{{ $expense->amount }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text"
                           name="category"
                           class="form-control"
                           value="{{ $expense->category }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expense Date</label>
                    <input type="date"
                           name="expense_date"
                           class="form-control"
                           value="{{ $expense->expense_date->format('Y-m-d') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note"
                              class="form-control">{{ $expense->note }}</textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">
                    Update Expense
                </button>
            </div>

        </form>
    </div>
</div>
@endforeach


<!-- OVERVIEW MODAL -->
<div class="modal fade" id="overviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Spending Overview</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <canvas id="overviewChart" height="260"></canvas>
            </div>

        </div>
    </div>
</div>
@endsection
