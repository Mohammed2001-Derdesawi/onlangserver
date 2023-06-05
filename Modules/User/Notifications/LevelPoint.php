<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LevelPoint extends Notification
{
    use Queueable;
    protected $level;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($level)
    {
        $this->level=$level;
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
            'title'=>'A new Point in '.$this->level->title_en,
            'message'=>'You have get  a new Point in '.$this->level->title_en." and  you will  earn:". $this->level->point_per_one * $this->level->point_price."$ if your account type money or if your are finished the campaign and get all gifts."
        ];
    }
}
