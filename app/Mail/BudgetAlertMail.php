<?php

namespace App\Mail;
use Illuminate\Mail\Mailable;

class BudgetAlertMail extends Mailable
{
    public function __construct(
        public int $threshold,
        public float $current
    ) {}

    public function build()
    {
        return $this->subject("Budget Alert: {$this->threshold}% reached")
            ->view('emails.budget-alert');
    }
}