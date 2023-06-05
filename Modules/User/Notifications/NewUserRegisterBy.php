<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegisterBy extends Notification
{
    use Queueable;

    public $register;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($register)
    {
        $this->register=$register;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>$this->register->name." has Register by your link",
            'message'=>"A new User has been register by you. You will get the points after ".$this->register->name ." buy a course "
        ];
    }
}
