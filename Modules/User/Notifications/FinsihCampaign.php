<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FinsihCampaign extends Notification
{
    use Queueable;

    public $user;
    public $lastlevel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$lastlevel)
    {
        $this->user=$user;
        $this->lastlevel=$lastlevel;
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
            'title'=>'You are Finished The Campaign what next?',
            'message'=>'You have already finished the last level in '.$this->lastlevel->campaign->title_en ."campaign and you will get now for every user register by you ".$this->lastlevel->point_price_after_done."$"        ];
    }
}
