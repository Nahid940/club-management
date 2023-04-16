<?php

namespace App\Mail;

use App\Models\EmailConfig;
use App\Services\DueCalculationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $payment;
    public function __construct($payment)
    {
        $this->payment=$payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(DueCalculationService $due)
    {
        $email_config=EmailConfig::select('email_greeting','email_footer','email_addressing')->first();
        $due_amount=$due->getDueOfMember($this->payment->member_id);
        return $this->from('cnbl940@cnbl.com.bd')->view('pages.payment.mail',['payment'=>$this->payment,'email_config'=>$email_config,'due_amount'=>$due_amount]);
    }
}
