<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Your Password</h2>

@if ($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('otp.password.reset') }}">
    @csrf

    <div>
        <input type="password"
               name="password"
               placeholder="New password"
               required>
    </div>

    <div>
        <input type="password"
               name="password_confirmation"
               placeholder="Confirm password"
               required>
    </div>

    <button type="submit">Reset Password</button>
</form>

</body>
</html>