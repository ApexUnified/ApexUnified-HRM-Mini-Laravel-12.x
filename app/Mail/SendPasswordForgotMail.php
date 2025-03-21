<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected $token) {}

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view("mail.PasswordForgot", ["token" => $this->token])
            ->subject("Forgot Password Mail");
    }
}
