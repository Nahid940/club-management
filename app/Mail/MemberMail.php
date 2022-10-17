<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $senderEmail = "nahid940@gmail.com";
        $senderMessage = "Hello I am from SES";
        $senderName = "Nahid";
        $data = [
            'senderEmail' => $senderEmail,
            'senderMessage' => $senderMessage,
            'senderName' => $senderName,
        ];
        return $this
            ->from(config('mail.contact.address'))
            ->replyTo($senderEmail, $senderName)
            ->view('pages.email.email')
            ->with($data);
    }
}
