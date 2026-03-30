<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
   public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'avatar' => 'nullable|image|max:2048', // 2MB
    ]);

    // Handle avatar upload
    if ($request->hasFile('avatar')) {

        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::disk(config('filesystems.default') === 'local' ? 'public' : 's3')->delete($user->avatar);
        }

        $disk = config('filesystems.default') === 'local' ? 'public' : 's3';
        $path = $request->file('avatar')->store('avatars', $disk);

        $user->avatar = $path;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return back()->with('success', 'Profile updated');
}

public function destroy(Request $request)
{
    $user = auth()->user();

    // Delete avatar if exists
    if ($user->avatar) {
        $disk = config('filesystems.default') === 'local' ? 'public' : 's3';
        Storage::disk($disk)->delete($user->avatar);
    }

    auth()->logout();
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Your account has been permanently deleted.');
}
}
