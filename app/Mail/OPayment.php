<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OPayment extends Mailable
{
    use Queueable, SerializesModels;
    public $payments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.otherPayment');
    }
}
