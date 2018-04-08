<?php

namespace App\Mail;
 // bron: https://www.5balloons.info/send-email-registration-laravel-authentication/ 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WedstrijdEmail extends Mailable
{
    use Queueable, SerializesModels;

    // public var aanmaken
    public $match;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // constructor die var opslaat zodat we ermee kunnen werken in de email template
    public function __construct($match)
    {
        $this->match = $match;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // email maken
    public function build()
    {
        // email template
        return $this->markdown('emails.WedstrijdEmail');
    }
}
