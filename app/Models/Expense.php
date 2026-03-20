<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'category',
        'expense_date',
        'note',
    ];
protected $casts = [
        'expense_date' => 'date',
    ];
    }
