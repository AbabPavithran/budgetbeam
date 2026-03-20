<!DOCTYPE html>
<html>
<body style="font-family: -apple-system, BlinkMacSystemFont, Arial, sans-serif; background-color: #ffffff; margin: 0; padding: 20px;">
    
    <!-- Header with Name and Logo -->
    <div style="margin-bottom: 24px;">
        <img src="{{ asset('images/budgetbeam-logo.png') }}" alt="Logo" style="width: 36px; height: auto; vertical-align: middle; margin-right: 8px;">
        <span style="font-size: 20px; font-weight: 700; color: #10B981; vertical-align: middle; letter-spacing: -0.5px;">BudgetBeam</span>
    </div>

    <!-- Alert String -->
    <div style="font-size: 16px; color: #1f2937;">
        @if($threshold == 50)
            💡 You have just reached <strong>{{ round($current) }}%</strong> of your monthly budget.
        @elseif($threshold == 90)
            <span style="color: #d97706; font-weight: 600;">⚠️ Warning:</span> You are currently at <strong>{{ round($current) }}%</strong> of your monthly limit.
        @elseif($threshold >= 100)
            <span style="color: #dc2626; font-weight: 600;">🚫 Budget Exceeded:</span> You have hit <strong>{{ round($current) }}%</strong>, surpassing your monthly allowance.
        @endif
    </div>

</body>
</html>