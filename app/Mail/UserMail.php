<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email from manager')->view($this->request,['data' => $this->data]);
    }
}
