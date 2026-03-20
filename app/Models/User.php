<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Wallet;

class User extends Authenticatable
{
    use Notifiable;

    // 🔹 Auto-create wallet when user is created
    protected static function booted()
    {
        static::created(function ($user) {
            $user->wallet()->create([
                'balance' => 0,
            ]);
        });
    }

    // 🔹 Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'theme',
        'avatar',
        'monthly_budget',
        'alert_50_sent',
        'alert_90_sent',
        'alert_100_sent',
    ];

    // 🔹 Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 Relationship: User → Wallet
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    // 🔹 Relationship: User → Expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}