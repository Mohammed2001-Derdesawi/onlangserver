<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StartNewLevel extends Notification
{
    use Queueable;

    public $newLevel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newLevel)
    {
        $this->newLevel=$newLevel;
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
            'title'=>'Started a new Level',
            'message'=>'you are now started '.$this->newLevel->title_en." Keep on!"
        ];
    }
}
