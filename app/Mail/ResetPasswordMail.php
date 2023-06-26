<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName, $linkCallback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $linkCallback)
    {
        $this->userName = $userName;
        $this->linkCallback = $linkCallback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("test@adoptaunpet.com")
                    ->subject("EMCODY API Reset Password")
                    ->view('emails.passwordResetMail');
    }
}
