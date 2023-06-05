<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Envelope;
class SendMessageByEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $text;
    public $subject;
    public $user;
    public $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message,$subject,$user,$sender='support.group@onlanguagecourses.com')
    {
        $this->text=$message;
        $this->subject=$subject;
        $this->user=$user;
        $this->sender=$sender;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender,'onlanguagecourses.com')->subject($this->subject)->view('user::User.mail.mail');
    }
}
