<?php

namespace App\Mail;

use App\Models\EmailConfig;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantBillMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $member;
    public function __construct($member)
    {
        $this->member=$member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_config=EmailConfig::select('email_greeting','email_footer','email_addressing')->first();
        return $this->from('cnbl940@cnbl.com.bd')->view('billing.bill-mail',['member'=>$this->member,'email_config'=>$email_config]);
    }
}
