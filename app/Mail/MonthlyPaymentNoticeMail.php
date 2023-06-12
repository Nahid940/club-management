<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonthlyPaymentNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $due;
    public function __construct($due)
    {
        $this->due=$due;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cnbl940@cnbl.com.bd')->subject('Monthly Payment')->view('pages.email.monthly_payment_notice',["due"=>$this->due]);
    }
}
