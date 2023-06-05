<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LevelGift extends Notification
{
    use Queueable;

    public $gifts;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($gifts)
    {
         $this->gifts=$gifts;
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
        $courses="";
        $count=count($this->gifts);
        $start=0;
        foreach($this->gifts as $gift){
            if($start==$count-1)
            $courses.=$gift->course->title_en;
            else
            $courses.=$gift->course->title_en .",";

        }
        return [
            'title'=>'You are get the Gift of The level',
            'message'=>"These courses are added to your courses List:".$courses
        ];
    }

}
