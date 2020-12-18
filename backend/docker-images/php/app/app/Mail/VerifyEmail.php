<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verify;
    
    /**
     * Create a new message instance.
     *
     * @param array $verify
     * @return void
     */
    public function __construct(array $verify)
    {
        $this->verify = $verify;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->verify['subject'])
	        ->view('verify_email', $this->verify);
    }
}
