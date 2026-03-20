<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BudgetBeam – Password Reset</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f4f6f8; padding:20px;">

    <div style="max-width:520px; margin:auto; background:#ffffff; padding:30px; border-radius:10px;">

        <!-- BRAND LOGO -->
        <div style="text-align:center; margin-bottom:20px;">
            <img src="{{ asset('images/budgetbeam.png') }}"
                 alt="BudgetBeam"
                 style="height:48px;">
        </div>

        <!-- GREETING -->
        <p style="color:#111827; font-size:15px;">
            Hi {{ $user->name }},
        </p>

        <p style="color:#374151; font-size:15px; line-height:1.6;">
            We received a request to reset your <strong>BudgetBeam</strong> account password.
            To continue, please use the One-Time Password (OTP) below.
        </p>

        <!-- OTP BOX -->
        <div style="margin:28px 0; text-align:center;">
            <div style="
                display:inline-block;
                font-size:30px;
                font-weight:700;
                letter-spacing:6px;
                color:#0f172a;
                background:#eef2ff;
                padding:14px 28px;
                border-radius:8px;
            ">
                {{ $otp }}
            </div>
        </div>

        <p style="color:#374151; font-size:14px;">
            This OTP is valid for <strong>10 minutes</strong>.
        </p>

        <!-- TINY WARNING -->
        <p style="color:#6b7280; font-size:13px; margin-top:12px;">
            For your security, please don’t share this code with anyone.
        </p>

        <p style="color:#6b7280; font-size:14px; margin-top:18px;">
            If you didn’t request a password reset, you can safely ignore this email.
            Your account remains secure.
        </p>

        <hr style="border:none; border-top:1px solid #e5e7eb; margin:26px 0;">

        <!-- THANK YOU -->
        <p style="color:#374151; font-size:14px;">
            Thank you for using <strong>BudgetBeam</strong>.
        </p>

        <p style="color:#9ca3af; font-size:13px;">
            Track smarter. Spend wiser.
        </p>

    </div>

</body>
</html>
