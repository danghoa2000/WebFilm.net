<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $token)
    {
        $this->view = $view;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email from manager')->view($this->view, ['token' => $this->token]);
    }
}
