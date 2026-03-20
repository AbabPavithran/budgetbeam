<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;

class PasswordOtpController extends Controller
{
    // Step 1: Show email form
    public function request()
    {
        return view('auth.forgot-password-otp');
    }

    // Step 2: Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found']);
        }

        $otp = rand(100000, 999999);

        DB::table('password_otps')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        Mail::to($user->email)->send(new PasswordOtpMail($otp,$user));


        session(['otp_email' => $request->email]);

        return redirect('/verify-otp')->with('status', 'OTP sent to your email');
    }

    // Step 3: Verify OTP page
    public function verifyForm()
    {
        return view('auth.verify-otp');
    }

    // Step 4: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $record = DB::table('password_otps')
            ->where('email', session('otp_email'))
            ->where('otp', $request->otp)
            ->first();

        if (!$record || Carbon::now()->gt($record->expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        session(['otp_verified' => true]);

        return redirect('/reset-password-otp');
    }

    // Step 5: Reset password form
    public function resetForm()
    {
        abort_unless(session('otp_verified'), 403);
        return view('auth.reset-password-otp');
    }

    // Step 6: Update password
    public function resetPassword(Request $request)
    {
        abort_unless(session('otp_verified'), 403);

        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::where('email', session('otp_email'))->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_otps')->where('email', $user->email)->delete();

        session()->forget(['otp_email', 'otp_verified']);

        return redirect('/login')->with('status', 'Password reset successfully');
    }
}
